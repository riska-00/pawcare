@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', $product->name . ' - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --ps-green:#128965; --ps-green-dark:#0e6e51; --ps-navy:#2A324C; --ps-coral:#EC5D5D; --ps-cream:#FFFAE8; }
    .ps-baloo{ font-family:'Baloo 2',sans-serif; }
    .ps-crumb{font-size:.85rem;color:#707378;margin-bottom:20px;}
    .ps-crumb a{color:#707378;text-decoration:none;}
    .ps-crumb a:hover{color:var(--ps-green);}

    .ps-photo-wrap{position:relative;border-radius:20px;overflow:hidden;aspect-ratio:1/1;background:#FFF3D6;}
    .ps-photo-wrap img{width:100%;height:100%;object-fit:cover;}
    .ps-fav-btn{position:absolute;top:16px;right:16px;width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.92);border:none;display:flex;align-items:center;justify-content:center;color:var(--ps-coral);font-size:1.1rem;}

    .ps-panel{background:#fff;border-radius:20px;border:1px solid #EFE6C0;padding:32px;height:100%;}
    .ps-cat{font-size:.78rem;color:#707378;text-transform:uppercase;letter-spacing:.03em;margin-bottom:6px;}
    .ps-name{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.7rem;color:var(--ps-navy);margin-bottom:6px;}
    .ps-price{color:var(--ps-green);font-weight:800;font-size:1.4rem;margin-bottom:16px;}
    .ps-stock{font-size:.85rem;color:#707378;margin-bottom:20px;}
    .ps-stock strong{color:var(--ps-navy);}

    .ps-desc-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--ps-navy);font-size:1rem;margin-bottom:8px;}
    .ps-desc-text{color:#5b5f6b;font-size:.92rem;line-height:1.6;margin-bottom:22px;}

    .ps-qty{display:flex;align-items:center;gap:14px;margin-bottom:18px;}
    .ps-qty input{width:70px;border:1px solid #EFE6C0;border-radius:10px;padding:8px;text-align:center;}

    .ps-btn{background:var(--ps-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:13px 0;width:100%;font-size:.95rem;}
    .ps-btn:hover{background:var(--ps-green-dark);color:#fff;}
    .ps-btn-outline{background:#fff;color:var(--ps-navy);border:2px solid var(--ps-navy);border-radius:12px;font-weight:700;padding:11px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.95rem;}
    .ps-btn-outline:hover{background:var(--ps-cream);color:var(--ps-navy);}
</style>
@endsection

@section('content')

<div class="container{{ Auth::user()->role !== 'admin' ? ' py-5' : '-fluid' }}">

    @if (Auth::user()->role === 'admin')
        <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Produk</h3>
        </div>
    @else
        <div class="ps-crumb">
            <a href="{{ route('products.index') }}">Produk</a> &gt; <span style="color:#2A324C;">{{ $product->name }}</span>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6">
            <div class="ps-photo-wrap">
                @if ($product->photo)
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <span class="text-muted">Tidak ada foto</span>
                    </div>
                @endif

                @if (Auth::user()->role !== 'admin')
                    <button type="button" class="ps-fav-btn" data-id="{{ $product->id }}" data-type="product"
                        onclick="toggleFavorite(this)" title="Tambah ke wishlist">
                        <i class="bi {{ $isFavorited ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                    </button>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="ps-panel">
                <div class="ps-cat">{{ $product->category }}</div>
                <div class="ps-name ps-baloo">{{ $product->name }}</div>
                <div class="ps-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="ps-stock">Stok tersedia: <strong>{{ $product->stock }}</strong></div>

                <div class="ps-desc-title ps-baloo">Deskripsi</div>
                <p class="ps-desc-text">{{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}</p>

                @if (Auth::user()->role === 'admin')
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="ps-btn text-decoration-none">
                            <i class="bi bi-pencil"></i> Edit Data
                        </a>
                        <a href="{{ route('products.index') }}" class="ps-btn-outline">Kembali</a>
                    </div>
                @else
                    @if ($product->stock > 0)
                        <form action="{{ route('carts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="ps-qty">
                                <label class="mb-0 fw-semibold" style="color:#2A324C;">Jumlah</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                            </div>
                            <button type="submit" class="ps-btn">Tambah ke Keranjang</button>
                        </form>
                    @else
                        <button type="button" class="ps-btn" style="background:#EFEFEF;color:#707378;" disabled>Stok Habis</button>
                    @endif
                @endif
            </div>
        </div>
    </div>

</div>

@endsection