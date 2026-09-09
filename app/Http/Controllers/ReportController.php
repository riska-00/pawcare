<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\CatReservation;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $type = $request->get('type', 'penjualan');
        $from = $request->get('from');
        $to = $request->get('to');

        $data = null;
        $totalPenjualan = 0;

        if ($type === 'penjualan') {
            $query = Order::with('user')->where('status', 'completed');
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->latest()->get();
            $totalPenjualan = $data->sum('total_price');
        }

        if ($type === 'pesanan') {
            $query = Order::with('user');
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->latest()->get();
        }

        if ($type === 'reservasi') {
            $query = CatReservation::with('cat', 'user');
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->latest()->get();
        }

        if ($type === 'kucing') {
            $query = Cat::query();
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->latest()->get();
        }

        if ($type === 'produk') {
            $query = Product::query();
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->latest()->get();
        }

        return view('pages.reports.index', compact('type', 'from', 'to', 'data', 'totalPenjualan'));
    }
}