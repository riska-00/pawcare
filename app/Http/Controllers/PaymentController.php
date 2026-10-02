<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $payments = Payment::with('order.user')->latest()->get();
        } else {
            $payments = Payment::with('order')
                ->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->latest()
                ->get();
        }

        return view(Auth::user()->role === 'admin' ? 'admin.payments.index' : 'user.payments.index', compact('payments'));
    }
    
    public function show(string $id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $payment->order->user_id !== Auth::id()) {
            abort(403);
        }

        return view(Auth::user()->role === 'admin' ? 'admin.payments.show' : 'user.payments.show', compact('payment'));
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $payment = Payment::with(['order.orderDetails.product', 'order.shipment'])
            ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        if (in_array($payment->status, ['confirmed', 'cancelled'])) {
            return back()->with(
                'error',
                'Pembayaran yang sudah dikonfirmasi atau dibatalkan tidak dapat diubah lagi.'
            );
        }

        if ($request->status === 'cancelled' && $payment->order->shipment->status === 'delivered') {
            return back()->with('error', 'Pesanan yang sudah diterima tidak dapat dibatalkan.');
        }

        if (
            $request->status === 'confirmed' &&
            $payment->order->shipment->status !== 'delivered'
        ) {
            return back()->with(
                'error',
                'Pembayaran tidak dapat dikonfirmasi sebelum pesanan diterima'
            );
        }

        DB::beginTransaction();

        try {
            if ($request->status === 'cancelled' && $payment->status !== 'cancelled') {

                foreach ($payment->order->orderDetails as $detail) {
                    $product = Product::where('id', $detail->product_id)
                        ->lockForUpdate()
                        ->first();

                    if ($product) {
                        $product->increment('stock', $detail->quantity);
                    }
                }

                $payment->order->update([
                    'status' => 'cancelled',
                ]);
            }

            $payment->update([
                'status' => $request->status,
                'confirmed_by' => in_array($request->status, ['confirmed', 'cancelled'])
                    ? Auth::id()
                    : $payment->confirmed_by,
                'paid_at' => $request->status === 'confirmed'
                    ? now()
                    : $payment->paid_at,
            ]);

            if ($request->status === 'confirmed') {
                $payment->order->update([
                    'status' => 'completed',
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.payments.index')
                ->with('success', 'Status pembayaran berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(
                'error',
                'Status pembayaran gagal diperbarui.'
            );
        }
    }
}