<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\CatReservation;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $kucingTersedia = Cat::where('status', 'available')->count();
        $reservasiPending = CatReservation::where('status', 'pending')->count();
        $pesananBaru = Order::where('status', 'pending')->count();
        $menungguVerifikasi = Payment::where('status', 'pending')->count();
        $totalPenjualan = Order::where('status', 'completed')->sum('total_price');
        $totalReservasi = CatReservation::count();
        $pesananDikirim = Shipment::where('status', 'shipped')->count();
        $codTerkumpul = Payment::where('status', 'confirmed')->sum('amount');

        $penjualanPerBulan = Order::where('status', 'completed')
            ->selectRaw('MONTH(created_at) as bulan, SUM(total_price) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labelBulan = [];
        $dataPenjualan = [];

        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        foreach (range(1, 12) as $bulan) {
            $labelBulan[] = $namaBulan[$bulan - 1];
            $item = $penjualanPerBulan->firstWhere('bulan', $bulan);
            $dataPenjualan[] = $item ? (float) $item->total : 0;
        }


        return view('admin.dashboard', compact('kucingTersedia', 'reservasiPending', 'pesananBaru', 'menungguVerifikasi', 'totalPenjualan', 'totalReservasi', 'pesananDikirim', 'codTerkumpul', 'labelBulan', 'dataPenjualan'));

    }
}
