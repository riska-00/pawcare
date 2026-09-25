@extends('layouts.app')

@section('title', 'Pengiriman - PawCare')

@section('styles')
<style>
    :root{ --sh-green:#128965; --sh-green-dark:#0e6e51; --sh-yellow:#FFD85C; --sh-navy:#2A324C; --sh-cream:#FFFAE8; }
    .sh-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--sh-navy);font-size:1.6rem;margin-bottom:20px;}

    .sh-card{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:18px 20px;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;text-decoration:none;transition:box-shadow .15s ease, transform .15s ease;}
    .sh-card:hover{box-shadow:0 8px 20px rgba(42,50,76,.1);transform:translateY(-2px);}
    .sh-code{font-size:.78rem;color:#707378;margin-bottom:4px;}
    .sh-resi{font-weight:700;color:var(--sh-navy);font-size:.92rem;}
    .sh-status{font-weight:700;font-size:.75rem;padding:5px 14px;border-radius:20px;white-space:nowrap;}
    .sh-status.pending{background:#EFEFEF;color:#707378;}
    .sh-status.shipped{background:var(--sh-yellow);color:var(--sh-navy);}
    .sh-status.delivered{background:var(--sh-green);color:#fff;}

    .sh-empty{text-align:center;padding:60px 20px;color:#707378;}
    .sh-empty i{font-size:2.6rem;color:#DCD3B2;margin-bottom:12px;display:block;}
</style>
@endsection

@section('content')

<div class="container py-4">

    <h3 class="sh-title">Pengiriman Saya</h3>

    @forelse ($shipments as $shipment)
        <a href="{{ route('shipments.show', $shipment->id) }}" class="sh-card">
            <div>
                <div class="sh-code">{{ $shipment->order->kode_pesanan ?? '-' }}</div>
                @if ($shipment->tracking_number)
                    <div class="sh-resi">No. Resi: {{ $shipment->tracking_number }}</div>
                @endif
            </div>
            <span class="sh-status {{ $shipment->status }}">{{ ucfirst($shipment->status) }}</span>
        </a>
    @empty
        <div class="sh-empty">
            <i class="bi bi-truck"></i>
            <p class="mb-0">Belum ada data pengiriman.</p>
        </div>
    @endforelse

</div>

@endsection