@extends('layouts.admin')

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

    .rs-btn{background:var(--rs-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:12px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.9rem;}
    .rs-btn:hover{background:var(--rs-green-dark);color:#fff;}
    .rs-btn-outline{background:#fff;color:var(--rs-navy);border:2px solid var(--rs-navy);border-radius:12px;font-weight:700;padding:10px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.9rem;}
</style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Reservasi</h3>
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="rs-panel mb-3">
                <div class="rs-panel-title">Informasi Reservasi</div>
                <div class="rs-row"><span>Kode Reservasi</span><span>{{ $catReservation->kode_reservasi }}</span></div>
                <div class="rs-row"><span>Kucing</span><span>{{ $catReservation->cat->name }} ({{ $catReservation->cat->breed }})</span></div>
                <div class="rs-row"><span>Tanggal Kunjungan</span><span>{{ $catReservation->visit_date->format('d M Y') }}</span></div>
                <div class="rs-row"><span>Catatan</span><span>{{ $catReservation->notes ?: '-' }}</span></div>
                <div class="rs-row">
                    <span>Status Saat Ini</span>
                    <span><span class="rs-status {{ $catReservation->status }}">{{ ucfirst($catReservation->status) }}</span></span>
                </div>
            </div>

            <div class="rs-panel">
                <div class="rs-panel-title">Informasi Pemesan</div>
                <div class="rs-row"><span>Nama</span><span>{{ $catReservation->user->name }}</span></div>
                <div class="rs-row"><span>Email</span><span>{{ $catReservation->user->email }}</span></div>
                <div class="rs-row"><span>No. Telepon</span><span>{{ $catReservation->user->phone ?: '-' }}</span></div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="rs-panel">
                <div class="rs-panel-title">Ubah Status</div>

                <form action="{{ route('admin.cat_reservations.update', $catReservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <select name="status" class="form-select">
                            <option value="confirmed" {{ $catReservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="paid" {{ $catReservation->status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="completed" {{ $catReservation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $catReservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="expired" {{ $catReservation->status === 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>

                    <button type="submit" class="rs-btn mb-2">Simpan Status</button>
                </form>

                <a href="{{ route('admin.cat_reservations.index') }}" class="rs-btn-outline">Kembali ke Daftar</a>
            </div>
        </div>
    </div>

</div>

@endsection