@extends('layouts.app')

@section('title', 'Pembayaran - PawCare')

@section('styles')
<style>
    :root{ --py-green:#128965; --py-green-dark:#0e6e51; --py-yellow:#FFD85C; --py-navy:#2A324C; --py-coral:#EC5D5D; --py-cream:#FFFAE8; }
    .py-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--py-navy);font-size:1.6rem;margin-bottom:20px;}

    .py-card{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:18px 20px;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;}
    .py-code{font-size:.78rem;color:#707378;margin-bottom:4px;}
    .py-amount{font-weight:800;color:var(--py-green);font-size:1.15rem;}
    .py-status{font-weight:700;font-size:.75rem;padding:5px 14px;border-radius:20px;white-space:nowrap;}
    .py-status.pending{background:var(--py-yellow);color:var(--py-navy);}
    .py-status.confirmed{background:var(--py-green);color:#fff;}
    .py-status.cancelled{background:#FCE2E2;color:var(--py-coral);}
    .py-detail-btn{background:var(--py-cream);color:var(--py-navy);border:none;border-radius:10px;padding:8px 18px;font-weight:600;font-size:.85rem;text-decoration:none;}
    .py-detail-btn:hover{background:#FFEBA6;color:var(--py-navy);}

    .py-empty{text-align:center;padding:60px 20px;color:#707378;}
    .py-empty i{font-size:2.6rem;color:#DCD3B2;margin-bottom:12px;display:block;}
</style>
@endsection

@section('content')

<div class="container py-4">

    <h3 class="py-title">Pembayaran Saya</h3>

    @forelse ($payments as $payment)
        <div class="py-card">
            <div>
                <div class="py-code">{{ $payment->order->kode_pesanan ?? '-' }}</div>
                <div class="py-amount">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="py-status {{ $payment->status }}">{{ ucfirst($payment->status) }}</span>
                <a href="{{ route('payments.show', $payment->id) }}" class="py-detail-btn">Lihat Detail</a>
            </div>
        </div>
    @empty
        <div class="py-empty">
            <i class="bi bi-receipt"></i>
            <p class="mb-0">Belum ada data pembayaran.</p>
        </div>
    @endforelse

</div>

@endsection