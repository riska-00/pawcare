@extends('layouts.app')

@section('title', 'Beranda - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --pc-green:#128965; --pc-green-dark:#0e6e51; --pc-yellow:#FFD85C; --pc-navy:#2A324C; --pc-coral:#EC5D5D; --pc-cream:#FFFAE8; }
    body{ background:var(--pc-cream); }
    .baloo{ font-family:'Baloo 2',sans-serif; }

    .pc-hero{ position:relative; padding:70px 0 60px; overflow:hidden;
        background: radial-gradient(circle at 12% 18%, rgba(18,137,101,.16) 0%, transparent 35%),
                    radial-gradient(circle at 88% 12%, rgba(255,216,92,.35) 0%, transparent 32%),
                    radial-gradient(circle at 90% 85%, rgba(236,93,93,.14) 0%, transparent 30%),
                    var(--pc-cream);
    }
    .pc-hero::after{content:"";position:absolute;left:0;right:0;bottom:0;height:70px;background:linear-gradient(to bottom, transparent, var(--pc-cream));}
    .pc-blob{position:absolute;border-radius:50%;opacity:.55;}
    .pc-b1{width:150px;height:150px;background:var(--pc-yellow);top:10px;left:6%;}
    .pc-b2{width:100px;height:100px;background:var(--pc-green);opacity:.18;bottom:10px;right:10%;}
    .pc-label-tag{display:inline-block;padding:4px 14px;border-radius:20px;background:#fff;border:2px solid var(--pc-navy);font-weight:700;font-size:.72rem;margin-bottom:14px;color:var(--pc-navy);}
    .pc-hero h1{font-size:2.6rem;font-weight:800;color:var(--pc-navy);}
    .pc-hero h1 span{color:var(--pc-green);}
    .pc-hero p{color:#5b5f6b;font-size:1.02rem;max-width:480px;margin:0 auto 26px;font-family:-apple-system,sans-serif;}
    .pc-btn-row a{padding:11px 26px;border-radius:30px;font-weight:700;text-decoration:none;display:inline-block;font-size:.88rem;}
    .pc-btn-solid{background:var(--pc-green);color:#fff;}
    .pc-btn-solid:hover{background:var(--pc-green-dark);color:#fff;}
    .pc-btn-outline-hero{border:2px solid var(--pc-navy);color:var(--pc-navy);background:#fff;}
    .pc-btn-outline-hero:hover{background:var(--pc-cream);color:var(--pc-navy);}

    .pc-feature-strip{display:flex;justify-content:center;gap:14px;margin-top:40px;flex-wrap:wrap;}
    .pc-feature-chip{background:#fff;border:2px solid var(--pc-navy);border-radius:16px;padding:12px 16px;display:flex;align-items:center;gap:8px;min-width:180px;}
    .pc-feature-chip i{font-size:1.2rem;color:var(--pc-green);}
    .pc-feature-chip .t{font-weight:700;font-size:.82rem;color:var(--pc-navy);}

    .pc-section-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--pc-navy);}
    .pc-section-sub{color:#707378;font-size:.88rem;margin-top:-6px;}

    .cc-tile{position:relative;border-radius:18px;overflow:hidden;height:240px;text-decoration:none;display:block;}
    .cc-tile img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:.3s;}
    .cc-tile:hover img{transform:scale(1.05);}
    .cc-tile::after{content:"";position:absolute;inset:0;background:linear-gradient(0deg, rgba(20,20,20,.75) 0%, rgba(20,20,20,.05) 55%, transparent 100%);}
    .cc-tile-content{position:absolute;bottom:0;left:0;right:0;padding:18px;color:#fff;}
    .cc-tile-tag{font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:var(--pc-yellow);margin-bottom:3px;}
    .cc-tile-name{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.2rem;margin-bottom:2px;}
    .cc-tile-price{font-size:.88rem;color:#eee;}
    .cc-tile-fav{position:absolute;top:12px;right:12px;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.9);border:none;display:flex;align-items:center;justify-content:center;color:var(--pc-coral);z-index:2;}

    .pp-row{background:#fff;border-radius:12px;border:1px solid #EFE6C0;display:flex;align-items:center;gap:14px;padding:12px 16px;margin-bottom:10px;}
    .pp-thumb{width:56px;height:56px;border-radius:10px;overflow:hidden;flex-shrink:0;background:#f2f2f2;display:flex;align-items:center;justify-content:center;font-size:.6rem;color:#707378;}
    .pp-thumb img{width:100%;height:100%;object-fit:cover;}
    .pp-info{flex:1;min-width:0;}
    .pp-name{font-weight:700;font-size:.92rem;color:var(--pc-navy);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .pp-cat{font-size:.72rem;color:#707378;}
    .pp-price{font-weight:700;color:var(--pc-green);font-size:.9rem;white-space:nowrap;}
    .pp-add{background:var(--pc-green);color:#fff;border:none;border-radius:8px;width:34px;height:34px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .pp-add:hover{background:var(--pc-green-dark);color:#fff;}

    .pc-stat-strip{display:flex;justify-content:center;gap:0;background:#fff;border-radius:20px 20px 0 0;overflow:hidden;border:1px solid #EFE6C0;border-bottom:none;}
    .pc-stat-item{flex:1;text-align:center;padding:28px 16px;border-right:1px solid #EFE6C0;}
    .pc-stat-item:last-child{border-right:none;}
    .pc-stat-num{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.9rem;color:var(--pc-green);}
    .pc-stat-label{font-size:.8rem;color:#707378;}

    .pc-cta-banner{background:var(--pc-green);border-radius:0 0 20px 20px;padding:44px;text-align:center;color:#fff;position:relative;overflow:hidden;}
    .pc-cta-banner::before{content:"";position:absolute;width:180px;height:180px;background:rgba(255,255,255,.08);border-radius:50%;top:-50px;right:-50px;}
    .pc-cta-banner h3{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.6rem;margin-bottom:8px;}
    .pc-cta-banner p{color:#DCF4EA;max-width:440px;margin:0 auto 22px;font-size:.92rem;}
    .pc-cta-btn{background:var(--pc-yellow);color:var(--pc-navy);padding:11px 28px;border-radius:30px;font-weight:700;text-decoration:none;display:inline-block;font-size:.9rem;}
    .pc-cta-outline{background:transparent;border:2px solid #fff;color:#fff;}
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="pc-hero text-center">
    <div class="pc-blob pc-b1"></div><div class="pc-blob pc-b2"></div>
    <div class="container position-relative baloo">
        <span class="pc-label-tag">🐾 Selamat Datang di PawCare</span>
        <h1>Temukan <span>Sahabat Berbulu</span><br>Impianmu di Sini</h1>
        <p style="font-family:-apple-system,sans-serif;">Kucing terbaik dan produk berkualitas untuk keluarga barumu, siap direservasi dengan penuh cinta.</p>
        <div class="pc-btn-row d-flex gap-2 justify-content-center flex-wrap">
            <a href="{{ route('cats.index') }}" class="pc-btn-solid">🐾 Lihat Kucing</a>
            <a href="{{ route('products.index') }}" class="pc-btn-outline-hero">🛍️ Belanja Produk</a>
        </div>
        <div class="pc-feature-strip">
            <div class="pc-feature-chip"><i class="bi bi-shield-check"></i><span class="t">Sehat & Terawat</span></div>
            <div class="pc-feature-chip"><i class="bi bi-star"></i><span class="t">Kualitas Terbaik</span></div>
            <div class="pc-feature-chip"><i class="bi bi-truck"></i><span class="t">Bayar di Tempat</span></div>
            <div class="pc-feature-chip"><i class="bi bi-clock"></i><span class="t">Reservasi Online</span></div>
        </div>
    </div>
</div>

<div class="container py-5">

    {{-- KUCING PILIHAN --}}
    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <h4 class="pc-section-title mb-0">🐾 Kucing Pilihan</h4>
        </div>
        <a href="{{ route('cats.index') }}" style="color:var(--pc-green);text-decoration:none;font-weight:600;font-size:.9rem;">Lihat Semua &rarr;</a>
    </div>
    <div class="row g-3 mb-5">
        @forelse ($cats as $cat)
            <div class="col-md-3 col-6">
                <a href="{{ route('cats.show', $cat->id) }}" class="cc-tile">
                    @if ($cat->photo)
                        <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100" style="background:#FFF3D6;">
                            <span class="text-muted small">Tidak ada foto</span>
                        </div>
                    @endif
                    <button type="button" class="cc-tile-fav" data-id="{{ $cat->id }}" data-type="cat"
                        onclick="event.preventDefault(); event.stopPropagation(); toggleFavorite(this)" title="Tambah ke wishlist">
                        <i class="bi bi-heart"></i>
                    </button>
                    <div class="cc-tile-content">
                        <div class="cc-tile-tag">Available</div>
                        <div class="cc-tile-name">{{ $cat->name }}</div>
                        <div class="cc-tile-price">Rp {{ number_format($cat->price, 0, ',', '.') }}</div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">Semua kucing sedang direservasi, cek lagi nanti ya! 🐱</p>
        @endforelse
    </div>

    {{-- PRODUK PILIHAN --}}
    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <h4 class="pc-section-title mb-0">🛍️ Produk Pilihan</h4>
        </div>
        <a href="{{ route('products.index') }}" style="color:var(--pc-green);text-decoration:none;font-weight:600;font-size:.9rem;">Lihat Semua &rarr;</a>
    </div>

    <div class="row mb-4">
        @forelse ($products as $product)
            <div class="col-md-6">
                <div class="pp-row">
                    <div class="pp-thumb">
                        @if ($product->photo)
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                        @else
                            No Photo
                        @endif
                    </div>
                    <div class="pp-info">
                        <div class="pp-name">{{ $product->name }}</div>
                        <div class="pp-cat">{{ $product->category }}</div>
                    </div>
                    <div class="pp-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @if ($product->stock > 0)
                        <form action="{{ route('carts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="pp-add"><i class="bi bi-plus-lg"></i></button>
                        </form>
                    @else
                        <button type="button" class="pp-add" style="background:#EFEFEF;color:#707378;" disabled><i class="bi bi-x-lg"></i></button>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">Produk akan segera hadir, cek lagi nanti ya! 🛍️</p>
        @endforelse
    </div>

    <div class="pc-closing" style="margin-top: 40px;">
        <div class="pc-stat-strip">
            <div class="pc-stat-item"><div class="pc-stat-num">100+</div><div class="pc-stat-label">Kucing Terawat</div></div>
            <div class="pc-stat-item"><div class="pc-stat-num">500+</div><div class="pc-stat-label">Pelanggan Puas</div></div>
            <div class="pc-stat-item"><div class="pc-stat-num">24/7</div><div class="pc-stat-label">Reservasi Online</div></div>
        </div>
        <div class="pc-cta-banner baloo">
            <h3>Siap Menemukan Sahabat Barumu?</h3>
            <p style="font-family:-apple-system,sans-serif;">Jelajahi koleksi kucing kami atau kenali lebih jauh cerita di balik PawCare Cat Care Center.</p>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
                <a href="{{ route('cats.index') }}" class="pc-cta-btn">Lihat Kucing</a>
                <a href="{{ route('about') }}" class="pc-cta-btn pc-cta-outline">Tentang Kami</a>
            </div>
        </div>
    </div>

</div>

@endsection