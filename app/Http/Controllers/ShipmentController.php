<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $shipments = Shipment::with('order.user')->latest()->get();
        } else {
            $shipments = Shipment::with('order')
                ->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->latest()
                ->get();
        }

        return view('shipments.index', compact('shipments'));
    }

    public function show(string $id)
    {
        $shipment = Shipment::with('order')->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $shipment->order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('shipments.show', compact('shipment'));
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $shipment = Shipment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,shipped,delivered',
            'courier' => 'required_if:status,shipped|nullable|string|max:255',
            'tracking_number' => 'required_if:status,shipped|nullable|string|max:255',
        ]);

        $data = [
            'status' => $request->status,
        ];

        if ($request->status === 'shipped') {
            $data['courier'] = $request->courier;
            $data['tracking_number'] = $request->tracking_number;
            $data['shipped_at'] = $shipment->shipped_at ?? now();
        }

        if ($request->status === 'delivered') {
            $data['delivered_at'] = $shipment->delivered_at ?? now();
        }

        $shipment->update($data);

        return redirect()
            ->route('shipments.index')
            ->with('success', 'Status pengiriman berhasil diperbarui.');
    }
}