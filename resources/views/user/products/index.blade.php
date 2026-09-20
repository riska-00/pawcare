@extends('layouts.app')

@section('title', 'Katalog Produk - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --pp-green:#128965; --pp-green-dark:#0e6e51; --pp-yellow:#FFD85C; --pp-navy:#2A324C; --pp-coral:#EC5D5D; --pp-cream:#FFFAE8; }
    .pp-baloo{ font-family:'Baloo 2',sans-serif; }
    .pp-hero{ position:relative; padding:50px 0 60px; overflow:hidden;
        background: radial-gradient(circle at 15% 20%, rgba(18,137,101,.14) 0%, transparent 35%),
                    radial-gradient(circle at 85% 15%, rgba(255,216,92,.3) 0%, transparent 32%),
                    var(--pp-cream);
    }
    .pp-hero::after{content:"";position:absolute;left:0;right:0;bottom:0;height:60px;background:linear-gradient(to bottom, transparent, var(--pp-cream));}
    .pp-blob{position:absolute;border-radius:50%;opacity:.5;}
    .pp-b1{width:130px;height:130px;background:var(--pp-yellow);top:10px;left:8%;}
    .pp-b2{width:90px;height:90px;background:var(--pp-coral);opacity:.15;bottom:0;right:10%;}
    .pp-hero h1{font-size:2.2rem;font-weight:800;color:var(--pp-navy);}
    .pp-hero h1 span{color:var(--pp-green);}
    .pp-hero p{color:#5b5f6b;font-size:.95rem;}
    .pp-search{max-width:520px;margin:20px auto 0;background:#fff;border-radius:50px;padding:8px;display:flex;box-shadow:0 8px 24px rgba(42,50,76,.1);border:1px solid #EFE6C0;}
    .pp-search input{border:none;flex:1;padding:9px 18px;background:transparent;font-size:.95rem;}
    .pp-search input:focus{outline:none;}
    .pp-search button{border:none;background:var(--pp-green);color:#fff;border-radius:50px;padding:0 22px;font-weight:700;}
    .pp-chips{display:flex;justify-content:center;gap:10px;margin-top:20px;flex-wrap:wrap;}
    .pp-chip{background:#fff;border:2px solid var(--pp-navy);border-radius:20px;padding:6px 16px;font-weight:700;font-size:.85rem;color:var(--pp-navy);text-decoration:none;}
    .pp-chip.on{background:var(--pp-green);color:#fff;border-color:var(--pp-green);}

    .pp-filter-bar{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:14px 18px;margin:24px 0;display:flex;flex-wrap:wrap;gap:10px;align-items:center;}
    .pp-filter-bar select, .pp-filter-bar input{border:1px solid #EFE6C0;border-radius:10px;padding:6px 12px;font-size:.85rem;}
    .pp-filter-bar button{border:none;background:var(--pp-yellow);color:var(--pp-navy);border-radius:10px;padding:7px 18px;font-weight:700;font-size:.85rem;}

    .pp-card{border-radius:16px;overflow:hidden;border:1px solid #EFE6C0;background:#fff;transition:.15s;}
    .pp-card:hover{transform:translateY(-3px);box-shadow:0 10px 22px rgba(42,50,76,.08);}
    .pp-img{height:170px;position:relative;background:#f2f2f2;}
    .pp-img img{width:100%;height:100%;object-fit:cover;}
    .pp-fav{position:absolute;top:8px;right:8px;width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,.92);border:none;display:flex;align-items:center;justify-content:center;color:var(--pp-coral);}
    .pp-body{padding:14px 16px;}
    .pp-cat{font-size:.72rem;color:#707378;margin-bottom:2px;}
    .pp-name{font-weight:700;font-size:.95rem;color:var(--pp-navy);margin-bottom:4px;}
    .pp-price{color:var(--pp-green);font-weight:700;font-size:.95rem;margin-bottom:10px;}
    .pp-btn{background:var(--pp-green);color:#fff;border:none;border-radius:8px;font-weight:600;font-size:.82rem;padding:8px 0;width:100%;}
    .pp-btn:hover{background:var(--pp-green-dark);color:#fff;}
    .pp-btn-disabled{background:#EFEFEF;color:#707378;border:none;border-radius:8px;font-weight:600;font-size:.82rem;padding:8px 0;width:100%;}
</style>
@endsection

@section('content')

<div class="pp-hero text-center">
    <div class="pp-blob pp-b1"></div>
    <div class="pp-blob pp-b2"></div>
    <div class="container position-relative pp-baloo">
        <h1>Belanja <span>Kebutuhan</span> Si Kucing</h1>
        <p style="font-family:-apple-system,sans-serif;">Produk berkualitas untuk sahabat berbulu kesayanganmu.</p>

        <form method="GET" action="{{ route('products.index') }}">
            @foreach (request()->except(['search', 'page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <div class="pp-search">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk...">
                <button type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <div class="pp-chips">
            <a href="{{ route('products.index', array_merge(request()->except(['category', 'page']), ['category' => ''])) }}"
               class="pp-chip {{ request('category') ? '' : 'on' }}">Semua</a>
            @foreach ($categories as $category)
                <a href="{{ route('products.index', array_merge(request()->except(['category', 'page']), ['category' => $category])) }}"
                   class="pp-chip {{ request('category') === $category ? 'on' : '' }}">{{ $category }}</a>
            @endforeach
        </div>
    </div>
</div>

<div class="container pb-5">

    <div class="pp-filter-bar">
        <form method="GET" action="{{ route('products.index') }}" class="d-flex flex-wrap gap-2 align-items-center w-100">
            <input type="hidden" name="search" value="{{ request('search') }}">

            <select name="category">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>

            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Harga Min">
            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Harga Max">

            <button type="submit" class="ms-auto">Terapkan</button>
        </form>
    </div>

    <div class="row g-3">
        @forelse ($products as $product)
            <div class="col-md-3 col-6">
                <div class="pp-card h-100">
                    <div class="pp-img">
                        @if ($product->photo)
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <span class="text-muted small">Tidak ada foto</span>
                            </div>
                        @endif
                        <button type="button" class="pp-fav" data-id="{{ $product->id }}" data-type="product"
                            onclick="toggleFavorite(this)" title="Tambah ke wishlist">
                            <i class="bi {{ $favoritedProductIds->contains($product->id) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                        </button>
                    </div>
                    <div class="pp-body">
                        <div class="pp-cat">{{ $product->category }}</div>
                        <div class="pp-name">{{ $product->name }}</div>
                        <div class="pp-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        @if ($product->stock > 0)
                            <form action="{{ route('carts.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="pp-btn">+ Keranjang</button>
                            </form>
                        @else
                            <button type="button" class="pp-btn-disabled" disabled>Stok Habis</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada produk yang tersedia.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

@endsection