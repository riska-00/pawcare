@extends('layouts.app')

@section('title', 'Detail Pembayaran - PawCare')

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-4" style="color: #2A324C;">Detail Pembayaran</h3>

    <div style="max-width: 620px;">
        <div class="card border-0 shadow-sm p-4">
            <table class="table table-borderless mb-3">
                <tr>
                    <th width="40%">Kode Pesanan</th>
                    <td>{{ $payment->order->kode_pesanan }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td class="fw-bold" style="color: #128965;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ strtoupper($payment->order->payment_method) }}</td>
                </tr>
                @if ($payment->paid_at)
                    <tr>
                        <th>Dikonfirmasi Pada</th>
                        <td>{{ $payment->paid_at->format('d M Y, H:i') }}</td>
                    </tr>
                @endif
            </table>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-bold" style="color: #2A324C;">Status</span>
                <span class="badge" style="background-color:
                    {{ $payment->status === 'confirmed' ? '#128965' : ($payment->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                    color: {{ $payment->status === 'pending' ? '#2A324C' : '#fff' }};">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>

            @if ($payment->status === 'pending')
                <div class="alert alert-light border small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Pembayaran akan dikonfirmasi oleh admin saat pesanan diantar (COD).
                </div>
            @endif
        </div>

        <a href="{{ route('orders.show', $payment->order_id) }}" class="btn btn-outline-secondary mt-3">
            &larr; Kembali ke Detail Pesanan
        </a>
    </div>

</div>

@endsection