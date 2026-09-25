@extends('layouts.admin')

@section('title', 'Pembayaran - PawCare')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Data Pembayaran</h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header py-3" style="background-color: #FFEBA6;">
            <h6 class="m-0 fw-bold" style="color: #2A324C;">Semua Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Pesanan</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->order->kode_pesanan ?? '-' }}</td>
                                <td>{{ $payment->order->user->name ?? '-' }}</td>
                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge" style="background-color:
                                        {{ $payment->status === 'confirmed' ? '#128965' : ($payment->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                                        color: {{ $payment->status === 'pending' ? '#2A324C' : '#fff' }};">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-link text-secondary p-0" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection