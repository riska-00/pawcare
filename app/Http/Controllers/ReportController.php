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
        $dataKucing = collect();
        $totalPenjualan = 0;
        $totalProduk = 0;
        $totalKucing = 0;

        if ($type === 'penjualan') {
            $query = Order::with('user')->where('status', 'completed');
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->latest()->get();

            $queryKucing = CatReservation::with('cat', 'user')->where('status', 'completed');
            if ($from) $queryKucing->whereDate('completed_at', '>=', $from);
            if ($to) $queryKucing->whereDate('completed_at', '<=', $to);
            $dataKucing = $queryKucing->latest('completed_at')->get();

            $totalProduk = $data->sum('total_price');
            $totalKucing = $dataKucing->sum(fn ($r) => $r->cat->price ?? 0);
            $totalPenjualan = $totalProduk + $totalKucing;
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

       return view('admin.reports.index', compact('type', 'from', 'to', 'data', 'dataKucing','totalPenjualan', 'totalProduk', 'totalKucing'));
    }
}