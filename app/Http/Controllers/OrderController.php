<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $orders = Order::with('user')->latest()->get();
        } else {
            $orders = Order::with(['orderDetails.product', 'payment', 'shipment'])
            ->where('user_id', Auth::id())->latest()->get();
        }

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return redirect()->route('carts.index')->with('error', 'Keranjang masih kosong');
        }

        return view('orders.create', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
        ]);

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('carts.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;

            foreach ($carts as $cart) {
                if ($cart->quantity > $cart->product->stock) {
                    DB::rollBack();

                    return back()->with(
                        'error',
                        'Stok produk ' . $cart->product->name . ' tidak mencukupi.'
                    );
                }

                $totalAmount += $cart->product->price * $cart->quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'shipping_address' => $request->shipping_address,
                'total_amount' => $totalAmount,
                'payment_method' => 'cod',
                'status' => 'pending',
            ]);

            foreach ($carts as $cart) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);

                $cart->product->decrement(
                    'stock',
                    $cart->quantity
                );
            }

            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'status' => 'pending',
            ]);

            Shipment::create([
                'order_id' => $order->id,
                'status' => 'pending',
            ]);

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(
                'error',
                'Pesanan gagal dibuat.'
            );
        }
    }

    public function show(string $id)
    {
        if (Auth::user()->role === 'admin') {
            $order = Order::with([
                'user',
                'orderDetails.product',
                'payment',
                'shipment'
            ])->findOrFail($id);
        } else {
            $order = Order::with([
                'orderDetails.product',
                'payment',
                'shipment'
            ])
                ->where('user_id', Auth::id())
                ->findOrFail($id);
        }

        return view('orders.show', compact('order'));
    }

}
