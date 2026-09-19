@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Pembayaran - PawCare')

@section('styles')
<style>
    :root{ --py-green:#128965; --py-green-dark:#0e6e51; --py-yellow:#FFD85C; --py-navy:#2A324C; --py-coral:#EC5D5D; --py-cream:#FFFAE8; }
    .py-baloo{font-family:'Baloo 2',sans-serif;}
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

@endif

@endsection