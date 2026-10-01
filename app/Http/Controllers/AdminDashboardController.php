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
        $totalReservasi = CatReservation::count();
        $pesananDikirim = Shipment::where('status', 'shipped')->count();
        $codTerkumpul = Payment::where('status', 'confirmed')->sum('amount');

        // total penjualan = penjualan produk + penjualan kucing
        $penjualanProduk = Order::where('status', 'completed')->sum('total_price');

        $penjualanKucing = 0;
        $reservasiSelesai = CatReservation::with('cat')->where('status', 'completed')->get();

        foreach ($reservasiSelesai as $reservasi) {
            $penjualanKucing += $reservasi->cat->price;
        }

        $totalPenjualan = $penjualanProduk + $penjualanKucing;

        $penjualanPerBulan = Order::where('status', 'completed')
            ->selectRaw('MONTH(created_at) as bulan, SUM(total_price) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $reservasiPerBulan = CatReservation::with('cat')
            ->where('status', 'completed')
            ->whereYear('completed_at', now()->year)
            ->get();

        $labelBulan = [];
        $dataPenjualan = [];

        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        foreach (range(1, 12) as $bulan) {
            $labelBulan[] = $namaBulan[$bulan - 1];
            $item = $penjualanPerBulan->firstWhere('bulan', $bulan);
            $total = $item ? (float) $item->total : 0;

            foreach ($reservasiPerBulan as $reservasi) {
                if ($reservasi->completed_at->month == $bulan) {
                    $total += $reservasi->cat->price;
                }
            }

            $dataPenjualan[] = $total;
        }

        return view('admin.dashboard', compact('kucingTersedia', 'reservasiPending', 'pesananBaru', 'menungguVerifikasi', 'totalPenjualan', 'totalReservasi', 'pesananDikirim', 'codTerkumpul', 'labelBulan', 'dataPenjualan'));
    }
}