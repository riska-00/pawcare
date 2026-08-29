@extends('layouts.admin')

@section('title', 'Dashboard - PawCare Admin')

@section('content')


    <div class="p-3 rounded mb-4" style="background-color: #FFD85C">   
      <h3 class="fw-bold mb-4" style="color: #2A324C;">Dashboard Admin</h3>
    </div>
 
    {{-- 4 kartu statistik atas --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #DCF4EA;">
                <div class="fs-3 fw-bold" style="color: #2A324C;">{{ $kucingTersedia }}</div>
                <div class="small" style="color: #707378;">Kucing Tersedia</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #FFEBA6;">
                <div class="fs-3 fw-bold" style="color: #2A324C;">{{ $reservasiPending }}</div>
                <div class="small" style="color: #707378;">Reservasi Pending</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #E1EFFC;">
                <div class="fs-3 fw-bold" style="color: #2A324C;">{{ $pesananBaru }}</div>
                <div class="small" style="color: #707378;">Pesanan Baru</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #FCE2E2;">
                <div class="fs-3 fw-bold" style="color: #2A324C;">{{ $menungguVerifikasi }}</div>
                <div class="small" style="color: #707378;">Menunggu Verifikasi</div>
            </div>
        </div>
    </div>
 
    {{-- Grafik (placeholder) & Aktivitas Terbaru --}}
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="p-4 rounded h-100 d-flex align-items-center justify-content-center"
                style="background-color: #FFFFFF; border: 1px solid #DCD3B2; min-height: 250px;">
                <div class="text-center" style="color: #707378;">
                    <i class="bi bi-bar-chart-line" style="font-size: 2rem;"></i>
                    <p class="mb-0 mt-2">Grafik penjualan akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded h-100" style="background-color: #FFFFFF; border: 1px solid #DCD3B2;">
                <div class="fw-bold mb-3" style="color: #2A324C;">Aktivitas Terbaru</div>
                <p class="small mb-0" style="color: #707378;">Belum ada aktivitas terbaru.</p>
            </div>
        </div>
    </div>
 
    {{-- 4 kartu statistik bawah --}}
    <div class="row g-3">
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #DCF4EA;">
                <div class="fs-4 fw-bold" style="color: #2A324C;">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
                <div class="small" style="color: #707378;">Total Penjualan</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #FFEBA6;">
                <div class="fs-4 fw-bold" style="color: #2A324C;">{{ $totalReservasi }}</div>
                <div class="small" style="color: #707378;">Total Reservasi</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #E1EFFC;">
                <div class="fs-4 fw-bold" style="color: #2A324C;">{{ $pesananDikirim }}</div>
                <div class="small" style="color: #707378;">Pesanan Dikirim</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="p-3 rounded" style="background-color: #EBE2FA;">
                <div class="fs-4 fw-bold" style="color: #2A324C;">Rp {{ number_format($codTerkumpul, 0, ',', '.') }}</div>
                <div class="small" style="color: #707378;">COD Terkumpul</div>
            </div>
        </div>
    </div>

@endsection