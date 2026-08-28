<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('payments.index', compact('payments'));
    }
    
    public function show(string $id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $payment->order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('payments.show', compact('payment'));
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $payment = Payment::with('order')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $payment->update([
            'status' => $request->status,
            'confirmed_by' => in_array($request->status, ['confirmed', 'cancelled']) ? Auth::id() : $payment->confirmed_by,
            'paid_at' => $request->status === 'confirmed' ? now() : $payment->paid_at,
        ]);

        if ($request->status === 'confirmed') {
            $payment->order->update(['status' => 'completed']);
        } elseif ($request->status === 'cancelled') {
            $payment->order->update(['status' => 'cancelled']);
        }

        return redirect()
            ->route('payments.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}