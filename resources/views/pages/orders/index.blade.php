@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Pesanan - PawCare')

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
    
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-4" style="color: #2A324C;">Pesanan Saya</h3>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                &larr; Lanjut Belanja
            </a>
        </div>

        @forelse ($orders as $order)
            <div class="card border-0 shadow-sm p-3 mb-3">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                    <div>
                        <div class="small text-muted mb-1">{{ $order->kode_pesanan }}</div>
                        <div class="small text-muted">{{ $order->created_at->format('d M Y') }}</div>
                    </div>
                    <span class="badge" style="background-color:
                        {{ $order->status === 'completed' ? '#128965' : ($order->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                        color: {{ $order->status === 'pending' ? '#2A324C' : '#fff' }};">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <hr class="my-2">

                <div class="mb-2">
                    @foreach ($order->orderDetails as $detail)
                        <div class="small text-muted">{{ $detail->product->name ?? 'Produk dihapus' }} &times; {{ $detail->quantity }}</div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold" style="color: #128965;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-bag-x" style="font-size: 2.5rem; color: #707378;"></i>
                <p class="text-muted mt-3 mb-3">Kamu belum punya pesanan.</p>
                <a href="{{ route('products.index') }}" class="btn" style="background-color: #128965; color: #fff;">
                    Belanja Sekarang
                </a>
            </div>
        @endforelse

    </div>

@endif

@endsection