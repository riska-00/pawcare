@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Detail Pesanan - PawCare')

@section('content')

<div class="container{{ Auth::user()->role !== 'admin' ? ' py-4' : '-fluid' }}">

    @if (Auth::user()->role === 'admin')
        <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Pesanan</h3>
        </div>
    @else
        <h3 class="fw-bold mb-4" style="color: #2A324C;">Detail Pesanan</h3>
    @endif

    <div class="row">
        <div class="col-md-7">

            <div class="card border-0 shadow-sm p-4 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0" style="color: #2A324C;">{{ $order->kode_pesanan }}</h6>
                    <span class="badge" style="background-color:
                        {{ $order->status === 'completed' ? '#128965' : ($order->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                        color: {{ $order->status === 'pending' ? '#2A324C' : '#fff' }};">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="35%">Tanggal Pesan</th>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Pengiriman</th>
                        <td>{{ $order->shipping_address }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>{{ strtoupper($order->payment_method) }}</td>
                    </tr>
                    @if (Auth::user()->role === 'admin')
                        <tr>
                            <th>Pemesan</th>
                            <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Produk Dipesan</h6>
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->product->name ?? 'Produk dihapus' }}</td>
                                <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td class="fw-bold" style="color: #128965;">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th style="color: #128965;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

        <div class="col-md-5">

            <div class="card border-0 shadow-sm p-4 mb-3">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Status Pembayaran</h6>
                @if ($order->payment)
                    <span class="badge mb-2" style="background-color:
                        {{ $order->payment->status === 'confirmed' ? '#128965' : ($order->payment->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                        color: {{ $order->payment->status === 'pending' ? '#2A324C' : '#fff' }};">
                        {{ ucfirst($order->payment->status) }}
                    </span>
                    <p class="small text-muted mb-0">Jumlah: Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</p>
                @else
                    <p class="text-muted small mb-0">Belum ada data pembayaran.</p>
                @endif
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Status Pengiriman</h6>
                @if ($order->shipment)
                    <span class="badge mb-2" style="background-color:
                        {{ $order->shipment->status === 'delivered' ? '#128965' : ($order->shipment->status === 'shipped' ? '#FFD85C' : '#EFEFEF') }};
                        color: {{ $order->shipment->status === 'pending' ? '#707378' : ($order->shipment->status === 'shipped' ? '#2A324C' : '#fff') }};">
                        {{ ucfirst($order->shipment->status) }}
                    </span>
                    @if ($order->shipment->courier)
                        <p class="small text-muted mb-0">Kurir: {{ $order->shipment->courier }}</p>
                    @endif
                    @if ($order->shipment->tracking_number)
                        <p class="small text-muted mb-0">No. Resi: {{ $order->shipment->tracking_number }}</p>
                    @endif
                @else
                    <p class="text-muted small mb-0">Belum ada data pengiriman.</p>
                @endif
            </div>

            <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.orders.index' : 'orders.index') }}"
                class="btn btn-outline-secondary w-100 mt-3">
                &larr; Kembali
            </a>

        </div>
    </div>

</div>

@endsection