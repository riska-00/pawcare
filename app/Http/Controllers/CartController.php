<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        return view('carts.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $request->quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Jumlah produk di keranjang melebihi stok yang tersedia.');
            }

            $cart->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('carts.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, string $id)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->quantity > $cart->product->stock) {
            return back()->with(
                'error',
                'Jumlah produk melebihi stok yang tersedia.'
            );
        }

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()
            ->route('carts.index')
            ->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->findOrFail($id);

        $cart->delete();

        return redirect()
            ->route('carts.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
