@extends('layouts.app')

@section('title', 'Detail Pesanan - PawCare')

@section('styles')
<style>
    :root{ --od-green:#128965; --od-green-dark:#0e6e51; --od-yellow:#FFD85C; --od-navy:#2A324C; --od-coral:#EC5D5D; --od-cream:#FFFAE8; }
    .od-back{display:inline-flex;align-items:center;gap:6px;font-size:.88rem;font-weight:600;color:var(--od-navy);text-decoration:none;margin-bottom:20px;}
    .od-back:hover{color:var(--od-green);}

    .od-panel{background:#fff;border-radius:20px;border:1px solid #EFE6C0;padding:28px;margin-bottom:20px;}
    .od-panel-top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:20px;}
    .od-code{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--od-navy);font-size:1.2rem;}
    .od-status{font-weight:700;font-size:.78rem;padding:6px 16px;border-radius:20px;}
    .od-status.pending{background:var(--od-yellow);color:var(--od-navy);}
    .od-status.paid{background:#DCF4EA;color:var(--od-green);}
    .od-status.completed{background:var(--od-green);color:#fff;}
    .od-status.cancelled{background:#FCE2E2;color:var(--od-coral);}

    .od-info-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
    .od-info-item{background:var(--od-cream);border-radius:12px;padding:12px 16px;}
    .od-info-label{font-size:.72rem;color:#707378;text-transform:uppercase;letter-spacing:.03em;margin-bottom:2px;}
    .od-info-value{font-weight:700;color:var(--od-navy);font-size:.9rem;}

    .od-section-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--od-navy);font-size:1.05rem;margin-bottom:14px;}
    .od-prod-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px dashed #EFE6C0;font-size:.9rem;}
    .od-prod-row:last-child{border-bottom:none;}
    .od-prod-name{color:var(--od-navy);font-weight:600;}
    .od-prod-qty{color:#707378;font-size:.8rem;}
    .od-prod-sub{font-weight:700;color:var(--od-green);}
    .od-total-row{display:flex;justify-content:space-between;align-items:center;padding-top:14px;margin-top:6px;border-top:2px solid var(--od-navy);}
    .od-total-label{font-weight:700;color:var(--od-navy);}
    .od-total-value{font-weight:800;color:var(--od-green);font-size:1.2rem;}

    .od-side-card{background:#fff;border-radius:16px;border:1px solid #EFE6C0;padding:20px;margin-bottom:14px;display:block;text-decoration:none;transition:box-shadow .15s ease, transform .15s ease;}
    .od-side-card.clickable{cursor:pointer;}
    .od-side-card.clickable:hover{box-shadow:0 8px 20px rgba(42,50,76,.1);transform:translateY(-2px);}
    .od-side-title{font-weight:700;color:var(--od-navy);font-size:.9rem;margin-bottom:10px;}
    .od-side-empty{color:#707378;font-size:.85rem;margin-bottom:0;}

    .od-side-link{font-size:.82rem;font-weight:600;color:var(--od-green);text-decoration:none;}
    .od-side-link:hover{color:var(--od-green-dark);text-decoration:underline;}
</style>
@endsection

@section('content')

<div class="container pt-3 pb-4">

    <h3 class="fw-bold mb-2" style="color: #2A324C;">Detail Pesanan</h3>

    <a href="{{ route('orders.index') }}" class="od-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Pesanan Saya
    </a>

    <div class="row g-4">
        <div class="col-md-8">

            <div class="od-panel">
                <div class="od-panel-top">
                    <div class="od-code">{{ $order->kode_pesanan }}</div>
                    <span class="od-status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>

                <div class="od-info-grid mb-4">
                    <div class="od-info-item">
                        <div class="od-info-label">Tanggal Pesan</div>
                        <div class="od-info-value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="od-info-item">
                        <div class="od-info-label">Metode Pembayaran</div>
                        <div class="od-info-value">{{ strtoupper($order->payment_method) }}</div>
                    </div>
                    <div class="od-info-item" style="grid-column: span 2;">
                        <div class="od-info-label">Alamat Pengiriman</div>
                        <div class="od-info-value">{{ $order->shipping_address }}</div>
                    </div>
                </div>

                <div class="od-section-title">Produk Dipesan</div>
                @foreach ($order->orderDetails as $detail)
                    <div class="od-prod-row">
                        <div>
                            <div class="od-prod-name">{{ $detail->product->name ?? 'Produk dihapus' }}</div>
                            <div class="od-prod-qty">{{ $detail->quantity }} &times; Rp {{ number_format($detail->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="od-prod-sub">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</div>
                    </div>
                @endforeach

                <div class="od-total-row">
                    <span class="od-total-label">Total</span>
                    <span class="od-total-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="od-side-card">
                <div class="od-side-title">Status Pembayaran</div>
                @if ($order->payment)
                    <span class="od-status {{ $order->payment->status === 'confirmed' ? 'completed' : $order->payment->status }} mb-2 d-inline-block">
                        {{ ucfirst($order->payment->status) }}
                    </span>
                    <p class="od-side-empty mb-2">Jumlah: Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</p>
                    <a href="{{ route('payments.show', $order->payment->id) }}" class="od-side-link">Lihat Detail Pembayaran &rarr;</a>
                @else
                    <p class="od-side-empty">Belum ada data pembayaran.</p>
                @endif
            </div>

            @if ($order->shipment)
                <a href="{{ route('shipments.show', $order->shipment->id) }}" class="od-side-card clickable">
                    <div class="od-side-title">Status Pengiriman</div>
                    <span class="od-status {{ $order->shipment->status === 'delivered' ? 'completed' : ($order->shipment->status === 'shipped' ? 'paid' : 'pending') }} mb-2 d-inline-block">
                        {{ ucfirst($order->shipment->status) }}
                    </span>
                    @if ($order->shipment->courier)
                        <p class="od-side-empty mb-1">Kurir: {{ $order->shipment->courier }}</p>
                    @endif
                    @if ($order->shipment->tracking_number)
                        <p class="od-side-empty mb-2">No. Resi: {{ $order->shipment->tracking_number }}</p>
                    @endif
                    <span class="od-side-link">Lihat Detail Pengiriman &rarr;</span>
                </a>
            @else
                <div class="od-side-card">
                    <div class="od-side-title">Status Pengiriman</div>
                    <p class="od-side-empty mb-0">Belum ada data pengiriman.</p>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection