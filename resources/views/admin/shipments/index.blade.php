@extends('layouts.admin')

@section('title', 'Pengiriman - PawCare')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Data Pengiriman</h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header py-3" style="background-color: #FFEBA6;">
            <h6 class="m-0 fw-bold" style="color: #2A324C;">Semua Pengiriman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Pesanan</th>
                            <th>Penerima</th>
                            <th>Kurir</th>
                            <th>No. Resi</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shipment->order->kode_pesanan ?? '-' }}</td>
                                <td>{{ $shipment->order->user->name ?? '-' }}</td>
                                <td>{{ $shipment->courier ?: '-' }}</td>
                                <td>{{ $shipment->tracking_number ?: '-' }}</td>
                                <td>
                                    <span class="badge" style="background-color:
                                        {{ $shipment->status === 'delivered' ? '#128965' : ($shipment->status === 'shipped' ? '#FFD85C' : '#EFEFEF') }};
                                        color: {{ $shipment->status === 'pending' ? '#707378' : ($shipment->status === 'shipped' ? '#2A324C' : '#fff') }};">
                                        {{ ucfirst($shipment->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.shipments.show', $shipment->id) }}" class="btn btn-link text-secondary p-0" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data pengiriman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection