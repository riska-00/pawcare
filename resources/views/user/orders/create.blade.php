@extends('layouts.app')

@section('title', 'Checkout - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --co-green:#128965; --co-green-dark:#0e6e51; --co-navy:#2A324C; --co-cream:#FFFAE8; }
    .co-baloo{ font-family:'Baloo 2',sans-serif; }

    .co-panel{background:#fff;border:1px solid #EFE6C0;border-radius:20px;padding:24px;margin-bottom:20px;}
    .co-panel-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--co-navy);font-size:1.05rem;margin-bottom:16px;}

    .co-item{display:flex;align-items:center;gap:14px;padding:10px 0;border-bottom:1px solid #F1EDE0;}
    .co-item:last-child{border-bottom:none;}
    .co-photo{width:52px;height:52px;border-radius:10px;overflow:hidden;flex-shrink:0;background:#FFF3D6;}
    .co-photo img{width:100%;height:100%;object-fit:cover;}
    .co-name{font-weight:700;color:var(--co-navy);font-size:.9rem;}
    .co-meta{font-size:.8rem;color:#707378;}
    .co-item-subtotal{font-weight:700;color:var(--co-green);font-size:.9rem;margin-left:auto;}

    .co-note{background:var(--co-cream);border-radius:12px;padding:14px 16px;font-size:.85rem;color:var(--co-navy);display:flex;align-items:center;gap:10px;margin-bottom:20px;}

    .co-btn{background:var(--co-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:13px 0;width:100%;font-size:.95rem;}
    .co-btn:hover{background:var(--co-green-dark);color:#fff;}
    .co-btn:disabled{opacity:.6;}

    .co-summary{background:#fff;border:1px solid #EFE6C0;border-radius:20px;padding:24px;}
    .co-row{display:flex;justify-content:space-between;font-size:.9rem;margin-bottom:10px;color:#5b5f6b;}
    .co-total{display:flex;justify-content:space-between;font-weight:700;color:var(--co-navy);font-size:1.05rem;}
    .co-total span:last-child{color:var(--co-green);}
</style>
@endsection

@section('content')

<div class="container py-4">

    <h3 class="co-baloo fw-bold mb-4" style="color: #2A324C;">Checkout</h3>

    @php
        $subtotal = 0;
    @endphp

    <div class="row g-4">
        <div class="col-md-8">

            <div class="co-panel">
                <div class="co-panel-title">Ringkasan Pesanan</div>

                @foreach ($carts as $cart)
                    @php
                        $itemSubtotal = $cart->product->price * $cart->quantity;
                        $subtotal += $itemSubtotal;
                    @endphp
                    <div class="co-item">
                        <div class="co-photo">
                            @if ($cart->product->photo)
                                <img src="{{ asset('storage/' . $cart->product->photo) }}" alt="{{ $cart->product->name }}">
                            @endif
                        </div>
                        <div>
                            <div class="co-name">{{ $cart->product->name }}</div>
                            <div class="co-meta">{{ $cart->quantity }} &times; Rp {{ number_format($cart->product->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="co-item-subtotal">Rp {{ number_format($itemSubtotal, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>

            <div class="co-panel">
                <div class="co-panel-title">Alamat Pengiriman</div>

                <form id="checkout-form" action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #2A324C;">Alamat Lengkap</label>
                        <textarea name="shipping_address" rows="4"
                            class="form-control @error('shipping_address') is-invalid @enderror"
                            placeholder="Tulis alamat lengkap untuk pengiriman COD">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="co-note">
                        <i class="bi bi-truck"></i>
                        <span>Pembayaran dilakukan di tempat (COD) saat pesanan diantar.</span>
                    </div>

                    <button type="submit" id="checkout-btn" class="co-btn">Buat Pesanan</button>
                </form>
            </div>

        </div>

        <div class="col-md-4">
            <div class="co-summary">
                <div class="co-panel-title">Ringkasan</div>

                <div class="co-row">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <hr style="border-color: #EFE6C0;">

                <div class="co-total">
                    <span>Total</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
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