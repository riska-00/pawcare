@extends('layouts.app')

@section('title', 'Detail Pengiriman - PawCare')

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-4" style="color: #2A324C;">Detail Pengiriman</h3>

    <div style="max-width: 620px;">
        <div class="card border-0 shadow-sm p-4">
            <table class="table table-borderless mb-3">
                <tr>
                    <th width="40%">Kode Pesanan</th>
                    <td>{{ $shipment->order->kode_pesanan }}</td>
                </tr>
                @if ($shipment->courier)
                    <tr>
                        <th>Kurir</th>
                        <td>{{ $shipment->courier }}</td>
                    </tr>
                @endif
                @if ($shipment->tracking_number)
                    <tr>
                        <th>No. Resi</th>
                        <td>{{ $shipment->tracking_number }}</td>
                    </tr>
                @endif
                @if ($shipment->shipped_at)
                    <tr>
                        <th>Dikirim Pada</th>
                        <td>{{ $shipment->shipped_at->format('d M Y, H:i') }}</td>
                    </tr>
                @endif
            </table>

            <hr>

            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold" style="color: #2A324C;">Status</span>
                <span class="badge" style="background-color:
                    {{ $shipment->status === 'delivered' ? '#128965' : ($shipment->status === 'shipped' ? '#FFD85C' : '#EFEFEF') }};
                    color: {{ $shipment->status === 'pending' ? '#707378' : ($shipment->status === 'shipped' ? '#2A324C' : '#fff') }};">
                    {{ ucfirst($shipment->status) }}
                </span>
            </div>
        </div>

        <a href="{{ route('orders.show', $shipment->order_id) }}" class="btn btn-outline-secondary mt-3">
            &larr; Kembali ke Detail Pesanan
        </a>
    </div>

</div>

@endsection