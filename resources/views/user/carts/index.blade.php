@extends('layouts.app')

@section('title', 'Keranjang - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --ct-green:#128965; --ct-green-dark:#0e6e51; --ct-navy:#2A324C; --ct-coral:#EC5D5D; --ct-cream:#FFFAE8; }
    .ct-baloo{ font-family:'Baloo 2',sans-serif; }

    .ct-item{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:16px;display:flex;align-items:center;gap:16px;margin-bottom:12px;}
    .ct-photo{width:64px;height:64px;border-radius:12px;overflow:hidden;flex-shrink:0;background:#FFF3D6;}
    .ct-photo img{width:100%;height:100%;object-fit:cover;}
    .ct-name{font-weight:700;color:var(--ct-navy);font-size:.95rem;}
    .ct-price{color:#707378;font-size:.85rem;}

    .ct-qty{display:flex;align-items:center;gap:10px;}
    .ct-qty-btn{width:30px;height:30px;border-radius:8px;border:1px solid #EFE6C0;background:#fff;display:flex;align-items:center;justify-content:center;color:var(--ct-navy);}
    .ct-qty-btn:disabled{opacity:.4;}
    .ct-qty-num{font-weight:700;color:var(--ct-navy);min-width:20px;text-align:center;}

    .ct-subtotal{font-weight:700;color:var(--ct-green);font-size:.95rem;min-width:110px;text-align:right;}
    .ct-del{width:34px;height:34px;border-radius:8px;border:1px solid #FCE2E2;background:#fff;color:var(--ct-coral);display:flex;align-items:center;justify-content:center;}

    .ct-summary{background:#fff;border:1px solid #EFE6C0;border-radius:20px;padding:24px;}
    .ct-summary-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--ct-navy);font-size:1.05rem;margin-bottom:18px;}
    .ct-row{display:flex;justify-content:space-between;font-size:.9rem;margin-bottom:10px;color:#5b5f6b;}
    .ct-total{display:flex;justify-content:space-between;font-weight:700;color:var(--ct-navy);font-size:1.05rem;}
    .ct-total span:last-child{color:var(--ct-green);}

    .ct-btn{background:var(--ct-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:13px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.95rem;}
    .ct-btn:hover{background:var(--ct-green-dark);color:#fff;}
    .ct-btn-outline{background:#fff;color:var(--ct-navy);border:2px solid var(--ct-navy);border-radius:12px;font-weight:700;padding:10px 24px;text-decoration:none;display:inline-block;font-size:.9rem;}
</style>
@endsection

@section('content')

<div class="container py-4">

    <h3 class="ct-baloo fw-bold mb-4" style="color: #2A324C;">Keranjang</h3>

    @if ($carts->isEmpty())

        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 2.5rem; color: #707378;"></i>
            <p class="text-muted mt-3 mb-3">Keranjang Anda masih kosong.</p>
            <a href="{{ route('products.index') }}" class="ct-btn" style="width: auto; display: inline-block; padding: 12px 28px;">
                Lihat Produk
            </a>
        </div>

    @else

        @php
            $subtotal = 0;
        @endphp

        <div class="row g-4">
            <div class="col-md-8">

                @foreach ($carts as $cart)
                    @php
                        $itemSubtotal = $cart->product->price * $cart->quantity;
                        $subtotal += $itemSubtotal;
                    @endphp
                    <div class="ct-item">
                        <div class="ct-photo">
                            @if ($cart->product->photo)
                                <img src="{{ asset('storage/' . $cart->product->photo) }}" alt="{{ $cart->product->name }}">
                            @endif
                        </div>

                        <div class="flex-fill">
                            <div class="ct-name">{{ $cart->product->name }}</div>
                            <div class="ct-price">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</div>
                        </div>

                        <div class="ct-qty">
                            <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $cart->quantity - 1 }}">
                                <button type="submit" class="ct-qty-btn" {{ $cart->quantity <= 1 ? 'disabled' : '' }}>−</button>
                            </form>
                            <span class="ct-qty-num">{{ $cart->quantity }}</span>
                            <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $cart->quantity + 1 }}">
                                <button type="submit" class="ct-qty-btn" {{ $cart->quantity >= $cart->product->stock ? 'disabled' : '' }}>+</button>
                            </form>
                        </div>

                        <div class="ct-subtotal">Rp {{ number_format($itemSubtotal, 0, ',', '.') }}</div>

                        <form action="{{ route('carts.delete', $cart->id) }}" method="POST" id="form-delete-cart-{{ $cart->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="ct-del" onclick="handleDeleteCart('{{ $cart->id }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach

                <a href="{{ route('products.index') }}" class="ct-btn-outline mt-2">
                    &larr; Lanjut Belanja
                </a>
            </div>

            <div class="col-md-4">
                <div class="ct-summary">
                    <div class="ct-summary-title">Ringkasan</div>

                    <div class="ct-row">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <hr style="border-color: #EFE6C0;">

                    <div class="ct-total mb-3">
                        <span>Total</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('orders.create') }}" class="ct-btn">Checkout</a>
                </div>
            </div>
        </div>

    @endif

</div>

<script>
    function handleDeleteCart(id) {
        Swal.fire({
            title: "Hapus produk ini?",
            text: "Produk akan dihapus dari keranjang.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-cart-' + id).submit();
            }
        });
    }
</script>

@endsection