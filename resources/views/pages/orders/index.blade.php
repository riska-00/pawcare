@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Pesanan - PawCare')

@section('styles')
<style>
    :root{ --os-green:#128965; --os-green-dark:#0e6e51; --os-yellow:#FFD85C; --os-navy:#2A324C; --os-coral:#EC5D5D; --os-cream:#FFFAE8; }
    .os-baloo{font-family:'Baloo 2',sans-serif;}
    .os-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:10px;}
    .os-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--os-navy);font-size:1.6rem;}
    .os-back{display:inline-flex;align-items:center;gap:6px;font-size:.88rem;font-weight:600;color:var(--os-navy);text-decoration:none;}
    .os-back:hover{color:var(--os-green);}

    .os-card{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:20px;margin-bottom:14px;}
    .os-card-top{display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:8px;margin-bottom:12px;}
    .os-code{font-size:.78rem;color:#707378;margin-bottom:2px;}
    .os-date{font-size:.78rem;color:#707378;}
    .os-status{font-weight:700;font-size:.75rem;padding:5px 14px;border-radius:20px;white-space:nowrap;}
    .os-status.pending{background:var(--os-yellow);color:var(--os-navy);}
    .os-status.paid{background:#DCF4EA;color:var(--os-green);}
    .os-status.completed{background:var(--os-green);color:#fff;}
    .os-status.cancelled{background:#FCE2E2;color:var(--os-coral);}

    .os-items{border-top:1px dashed #EFE6C0;border-bottom:1px dashed #EFE6C0;padding:10px 0;margin-bottom:14px;}
    .os-item-line{font-size:.85rem;color:#5b5f6b;padding:3px 0;}
    .os-item-line b{color:var(--os-navy);}

    .os-footer{display:flex;justify-content:space-between;align-items:center;}
    .os-total{font-weight:800;color:var(--os-green);font-size:1.1rem;}
    .os-detail-btn{background:var(--os-cream);color:var(--os-navy);border:none;border-radius:10px;padding:8px 18px;font-weight:600;font-size:.85rem;text-decoration:none;}
    .os-detail-btn:hover{background:#FFEBA6;color:var(--os-navy);}

    .os-empty{text-align:center;padding:60px 20px;color:#707378;}
    .os-empty i{font-size:2.6rem;color:#DCD3B2;margin-bottom:12px;display:block;}
    .os-empty a{background:var(--os-green);color:#fff;border-radius:30px;padding:11px 28px;font-weight:700;text-decoration:none;display:inline-block;margin-top:14px;font-size:.9rem;}
    .os-empty a:hover{background:var(--os-green-dark);color:#fff;}
</style>
@endsection

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN ================= --}}
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Data Pesanan</h3>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header py-3" style="background-color: #FFEBA6;">
                <h6 class="m-0 fw-bold" style="color: #2A324C;">Semua Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Kode Pesanan</th>
                                <th>Pemesan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->kode_pesanan }}</td>
                                    <td>{{ $order->user->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge" style="background-color:
                                            {{ $order->status === 'completed' ? '#128965' : ($order->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                                            color: {{ $order->status === 'pending' ? '#2A324C' : '#fff' }};">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-link text-secondary p-0" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada pesanan.</td>
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

        <div class="os-header">
            <h3 class="os-title mb-0">Pesanan Saya</h3>
            <a href="{{ route('products.index') }}" class="os-back">
                <i class="bi bi-arrow-left"></i> Lanjut Belanja
            </a>
        </div>

        @forelse ($orders as $order)
            <div class="os-card">
                <div class="os-card-top">
                    <div>
                        <div class="os-code">{{ $order->kode_pesanan }}</div>
                        <div class="os-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <span class="os-status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>

                <div class="os-items">
                    @foreach ($order->orderDetails as $detail)
                        <div class="os-item-line">
                            <b>{{ $detail->product->name ?? 'Produk dihapus' }}</b> &times; {{ $detail->quantity }}
                        </div>
                    @endforeach
                </div>

                <div class="os-footer">
                    <span class="os-total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    <a href="{{ route('orders.show', $order->id) }}" class="os-detail-btn">Lihat Detail</a>
                </div>
            </div>
        @empty
            <div class="os-empty">
                <i class="bi bi-bag-x"></i>
                <p class="mb-0">Kamu belum punya pesanan.</p>
                <a href="{{ route('products.index') }}">Belanja Sekarang</a>
            </div>
        @endforelse

    </div>

@endif

@endsection