@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Pengiriman - PawCare')

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN ================= --}}
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

@else

    {{-- ================= TAMPILAN USER ================= --}}
    <div class="container py-4">

        <h3 class="fw-bold mb-4" style="color: #2A324C;">Pengiriman Saya</h3>

        @forelse ($shipments as $shipment)
            <div class="card border-0 shadow-sm p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <div class="small text-muted mb-1">{{ $shipment->order->kode_pesanan ?? '-' }}</div>
                        @if ($shipment->tracking_number)
                            <div class="small">No. Resi: {{ $shipment->tracking_number }}</div>
                        @endif
                    </div>
                    <span class="badge" style="background-color:
                        {{ $shipment->status === 'delivered' ? '#128965' : ($shipment->status === 'shipped' ? '#FFD85C' : '#EFEFEF') }};
                        color: {{ $shipment->status === 'pending' ? '#707378' : ($shipment->status === 'shipped' ? '#2A324C' : '#fff') }};">
                        {{ ucfirst($shipment->status) }}
                    </span>
                </div>
                <a href="{{ route('shipments.show', $shipment->id) }}" class="btn btn-sm btn-outline-secondary mt-3 align-self-start">
                    Lihat Detail
                </a>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-truck" style="font-size: 2.5rem; color: #707378;"></i>
                <p class="text-muted mt-3">Belum ada data pengiriman.</p>
            </div>
        @endforelse

    </div>

@endif

@endsection