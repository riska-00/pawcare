@extends('layouts.app')

@section('title', 'Detail Reservasi - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --rs-green:#128965; --rs-green-dark:#0e6e51; --rs-yellow:#FFD85C; --rs-navy:#2A324C; --rs-cream:#FFFAE8; }
    .rs-baloo{ font-family:'Baloo 2',sans-serif; }
    .rs-panel{background:#fff;border:1px solid #EFE6C0;border-radius:20px;padding:28px;}
    .rs-panel-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--rs-navy);font-size:1.05rem;margin-bottom:16px;}
    .rs-row{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #F1EDE0;font-size:.9rem;}
    .rs-row:last-child{border-bottom:none;}
    .rs-row span:first-child{color:#707378;}
    .rs-row span:last-child{font-weight:600;color:var(--rs-navy);text-align:right;}

    .rs-status{font-size:.78rem;font-weight:700;padding:5px 14px;border-radius:20px;display:inline-block;}
    .rs-status.pending{background:#FFEBA6;color:#2A324C;}
    .rs-status.confirmed{background:#DCF4EA;color:#128965;}
    .rs-status.paid{background:#128965;color:#fff;}
    .rs-status.completed{background:#2A324C !important;color:#fff !important;}
    .rs-status.cancelled{background:#FCE2E2;color:#EC5D5D;}
    .rs-status.expired{background:#EFEFEF;color:#707378;}

    .rs-success{text-align:center;padding:8px 0;}
    .rs-success i{font-size:2.6rem;color:var(--rs-green);}
    .rs-success h4{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--rs-navy);margin:12px 0 4px;}

    .rs-btn{background:var(--rs-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:12px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.9rem;}
    .rs-btn:hover{background:var(--rs-green-dark);color:#fff;}
    .rs-btn-outline{background:#fff;color:var(--rs-navy);border:2px solid var(--rs-navy);border-radius:12px;font-weight:700;padding:10px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.9rem;}
</style>
@endsection

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="rs-panel mb-3">
                <div class="rs-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <h4 class="rs-baloo">Reservasi Berhasil</h4>
                    <p class="text-muted mb-0">Terima kasih, reservasi Anda telah kami terima.</p>
                </div>
            </div>

            <div class="rs-panel mb-3">
                <div class="rs-panel-title">Detail Reservasi</div>
                <div class="rs-row"><span>Kode Reservasi</span><span>{{ $catReservation->kode_reservasi }}</span></div>
                <div class="rs-row"><span>Kucing</span><span>{{ $catReservation->cat->name }} ({{ $catReservation->cat->breed }})</span></div>
                <div class="rs-row"><span>Tanggal Kunjungan</span><span>{{ $catReservation->visit_date->format('d M Y') }}</span></div>
                <div class="rs-row"><span>Catatan</span><span>{{ $catReservation->notes ?: '-' }}</span></div>
                <div class="rs-row">
                    <span>Status</span>
                    <span><span class="rs-status {{ $catReservation->status }}">{{ ucfirst($catReservation->status) }}</span></span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('home') }}" class="rs-btn-outline">Kembali ke Beranda</a>
                <a href="{{ route('cat_reservations.index') }}" class="rs-btn">Lihat Riwayat Reservasi</a>
            </div>

        </div>
    </div>
</div>

@endsection