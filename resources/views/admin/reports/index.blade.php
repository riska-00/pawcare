@extends('layouts.admin')

@section('title', 'Laporan - PawCare Admin')

@section('content')

<div class="container-fluid">

    <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Laporan</h3>
    </div>

    {{-- Tab pilihan laporan --}}
    <ul class="nav nav-tabs mb-3">
        @php
            $tabs = [
                'penjualan' => 'Penjualan',
                'pesanan' => 'Pesanan',
                'reservasi' => 'Reservasi Kucing',
                'kucing' => 'Data Kucing',
                'produk' => 'Stok Produk',
            ];
        @endphp
        @foreach ($tabs as $key => $label)
            <li class="nav-item">
                <a class="nav-link {{ $type === $key ? 'active fw-bold' : '' }}"
                   style="{{ $type === $key ? 'color: #128965;' : 'color: #2A324C;' }}"
                   href="{{ route('admin.reports.index', ['type' => $key, 'from' => $from, 'to' => $to]) }}">
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- Filter tanggal --}}
    <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-2 mb-3">
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="col-md-3">
            <label class="form-label small">Dari Tanggal</label>
            <input type="date" name="from" value="{{ $from }}" class="form-control form-control-sm">
        </div>
        <div class="col-md-3">
            <label class="form-label small">Sampai Tanggal</label>
            <input type="date" name="to" value="{{ $to }}" class="form-control form-control-sm">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-sm w-100" style="background-color: #128965; color: #fff;">Terapkan</button>
        </div>
        @if ($from || $to)
            <div class="col-md-2 d-flex align-items-end">
                <a href="{{ route('admin.reports.index', ['type' => $type]) }}" class="btn btn-sm btn-outline-secondary w-100">Reset</a>
            </div>
        @endif
    </form>

    <div class="card shadow-sm border-0">
        <div class="card-header py-3" style="background-color: #FFEBA6;">
            <h6 class="m-0 fw-bold" style="color: #2A324C;">{{ $tabs[$type] }}</h6>
        </div>
        <div class="card-body">

            {{-- LAPORAN PENJUALAN --}}
            @if ($type === 'penjualan')
                <div class="alert alert-light border mb-3">
                    <strong>Total Penjualan:</strong> Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                    ({{ $data->count() }} pesanan selesai)
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th><th>Kode Pesanan</th><th>Pemesan</th><th>Tanggal</th><th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->kode_pesanan }}</td>
                                    <td>{{ $order->user->name ?? '-' }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada penjualan pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- LAPORAN PESANAN --}}
            @if ($type === 'pesanan')
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th><th>Kode Pesanan</th><th>Pemesan</th><th>Tanggal</th><th>Total</th><th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->kode_pesanan }}</td>
                                    <td>{{ $order->user->name ?? '-' }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge" style="background-color:
                                            {{ $order->status === 'completed' ? '#128965' : ($order->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                                            color: {{ $order->status === 'pending' ? '#2A324C' : '#fff' }};">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pesanan pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- LAPORAN RESERVASI KUCING --}}
            @if ($type === 'reservasi')
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th><th>Kode</th><th>Kucing</th><th>User</th><th>Tgl Kunjungan</th><th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $reservation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reservation->kode_reservasi }}</td>
                                    <td>{{ $reservation->cat->name ?? '-' }}</td>
                                    <td>{{ $reservation->user->name ?? '-' }}</td>
                                    <td>{{ $reservation->visit_date->format('d M Y') }}</td>
                                    <td>{{ ucfirst($reservation->status) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada reservasi pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- LAPORAN DATA KUCING --}}
            @if ($type === 'kucing')
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th><th>Nama</th><th>Ras</th><th>Harga</th><th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $cat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ $cat->breed }}</td>
                                    <td>Rp {{ number_format($cat->price, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($cat->status) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data kucing pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- LAPORAN STOK PRODUK --}}
            @if ($type === 'produk')
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge" style="background-color: {{ $product->stock <= 5 ? '#EC5D5D' : '#128965' }};">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data produk pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection