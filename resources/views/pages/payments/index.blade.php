@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Pembayaran - PawCare')

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN ================= --}}
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
                                        <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-link text-secondary p-0" title="Detail">
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

@else

    {{-- ================= TAMPILAN USER ================= --}}
    <div class="container py-4">

        <h3 class="fw-bold mb-4" style="color: #2A324C;">Pembayaran Saya</h3>

        @forelse ($payments as $payment)
            <div class="card border-0 shadow-sm p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <div class="small text-muted mb-1">{{ $payment->order->kode_pesanan ?? '-' }}</div>
                        <div class="fw-bold" style="color: #128965;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                    </div>
                    <span class="badge" style="background-color:
                        {{ $payment->status === 'confirmed' ? '#128965' : ($payment->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                        color: {{ $payment->status === 'pending' ? '#2A324C' : '#fff' }};">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-outline-secondary mt-3 align-self-start">
                    Lihat Detail
                </a>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-receipt" style="font-size: 2.5rem; color: #707378;"></i>
                <p class="text-muted mt-3">Belum ada data pembayaran.</p>
            </div>
        @endforelse

    </div>

@endif

@endsection