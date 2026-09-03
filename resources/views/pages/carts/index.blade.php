@extends('layouts.app')

@section('title', 'Keranjang - PawCare')

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-4" style="color: #2A324C;">Keranjang</h3>

    @if ($carts->isEmpty())

        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 2.5rem; color: #707378;"></i>
            <p class="text-muted mt-3 mb-3">Keranjang Anda masih kosong.</p>
            <a href="{{ route('products.index') }}" class="btn" style="background-color: #128965; color: #fff;">
                Lihat Produk
            </a>
        </div>

    @else

        @php
            $subtotal = 0;
        @endphp

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
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
                                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                                                        style="width: 50px; height: 50px; border-radius: 8px; font-size: 0.65rem;">No Photo</div>
                                                @endif
                                                <span class="small fw-bold">{{ $cart->product->name }}</span>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity" value="{{ $cart->quantity - 1 }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary" {{ $cart->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                                </form>

                                                <span class="mx-2">{{ $cart->quantity }}</span>

                                                <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity" value="{{ $cart->quantity + 1 }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary" {{ $cart->quantity >= $cart->product->stock ? 'disabled' : '' }}>+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="fw-bold" style="color: #128965;">Rp {{ number_format($itemSubtotal, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('carts.delete', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-3">
                    &larr; Lanjut Belanja
                </a>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Ringkasan</h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold" style="color: #128965;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('orders.create') }}" class="btn w-100" style="background-color: #128965; color: #fff;">
                        Checkout
                    </a>
                </div>
            </div>
        </div>

    @endif

</div>

@endsection