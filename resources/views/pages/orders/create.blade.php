@extends('layouts.app')

@section('title', 'Checkout - PawCare')

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-4" style="color: #2A324C;">Checkout</h3>

    @php
        $subtotal = 0;
    @endphp

    <div class="row">
        <div class="col-md-8">

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header py-3" style="background-color: #FFEBA6;">
                    <h6 class="m-0 fw-bold" style="color: #2A324C;">Ringkasan Pesanan</h6>
                </div>
                <div class="card-body p-0">
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
                            @foreach ($carts as $cart)
                                @php
                                    $itemSubtotal = $cart->product->price * $cart->quantity;
                                    $subtotal += $itemSubtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($cart->product->photo)
                                                <img src="{{ asset('storage/' . $cart->product->photo) }}" alt="{{ $cart->product->name }}"
                                                    style="width: 46px; height: 46px; object-fit: cover; border-radius: 8px;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                                                    style="width: 46px; height: 46px; border-radius: 8px; font-size: 0.6rem;">No Photo</div>
                                            @endif
                                            <span class="small fw-bold">{{ $cart->product->name }}</span>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td class="fw-bold" style="color: #128965;">Rp {{ number_format($itemSubtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Alamat Pengiriman</h6>

                <form id="checkout-form" action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="shipping_address" rows="4"
                            class="form-control @error('shipping_address') is-invalid @enderror"
                            placeholder="Tulis alamat lengkap untuk pengiriman COD">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-light border small mb-3">
                        <i class="bi bi-truck me-1"></i>
                        Pembayaran dilakukan di tempat (COD) saat pesanan diantar.
                    </div>

                    <button type="submit" id="checkout-btn" class="btn w-100" style="background-color: #128965; color: #fff;">
                        Buat Pesanan
                    </button>
                </form>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Ringkasan</h6>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold" style="color: #128965;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('checkout-form').addEventListener('submit', function () {
        document.getElementById('checkout-btn').disabled = true;
        document.getElementById('checkout-btn').innerText = 'Memproses...';
    });
</script>

@endsection