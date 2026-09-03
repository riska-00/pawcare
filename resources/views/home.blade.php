@extends('layouts.app')

@section('title', 'Beranda - PawCare')

@section('styles')
<style>
    :root {
        --pc-green: #128965;
        --pc-yellow: #FFD85C;
        --pc-navy: #2A324C;
        --pc-cream: #FFFAE8;
    }

    .pc-hero {
        position: relative;
        background: var(--pc-green);
        overflow: hidden;
        min-height: 440px;
        display: flex;
        align-items: center;
    }

    .pc-hero::after {
        content: "";
        position: absolute;
        top: 0; right: 0; bottom: 0;
        width: 45%;
        background: var(--pc-cream);
        clip-path: polygon(30% 0, 100% 0, 100% 100%, 0% 100%);
    }

    .pc-hero .content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 40px 0;
    }

    .pc-hero .eyebrow {
        background: rgba(255,255,255,.15);
        padding: 5px 14px;
        border-radius: 20px;
        font-size: .75rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 16px;
    }

    .pc-hero h1 {
        font-family: 'Baloo 2', sans-serif;
        font-weight: 800;
        font-size: 2.6rem;
        line-height: 1.15;
        margin-bottom: 14px;
    }

    .pc-hero h1 span {
        color: var(--pc-yellow);
    }

    .pc-hero p {
        color: #DCF4EA;
        max-width: 400px;
        margin-bottom: 24px;
    }

    .pc-hero .btns a {
        padding: 12px 24px;
        border-radius: 30px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .9rem;
        min-width: 170px;
        text-align: center;
    }

    .pc-btn-yellow {
        background: var(--pc-yellow);
        color: var(--pc-navy);
    }

    .pc-btn-outline-hero {
        border: 2px solid #fff;
        color: #fff;
        background: transparent;
    }

    .pc-btn-outline-hero:hover {
        background: rgba(255,255,255,.15);
        color: #fff;
    }

    .pc-hero-photo {
        position: absolute;
        right: 4%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        width: 280px;
        height: 340px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,.25);
    }

    .pc-hero-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pc-feature-row {
        display: flex;
        justify-content: center;
        gap: 0;
        margin-top: -30px;
        position: relative;
        z-index: 4;
        flex-wrap: wrap;
    }

    .pc-feature-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(42,50,76,.08);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 8px;
        flex: 1;
        min-width: 200px;
        max-width: 230px;
    }

    .pc-feature-card i {
        font-size: 1.4rem;
        color: var(--pc-green);
    }

    .pc-feature-card .t {
        font-weight: 700;
        font-size: .85rem;
        color: var(--pc-navy);
    }

    .pc-feature-card .d {
        font-size: .72rem;
        color: #707378;
    }

    .pc-section-title {
        font-family: 'Baloo 2', sans-serif;
        font-weight: 800;
        color: var(--pc-navy);
    }

    @media (max-width: 767px) {
        .pc-hero::after { width: 0; }
        .pc-hero-photo { display: none; }
        .pc-hero h1 { font-size: 2rem; }
    }
</style>
@endsection

@section('content')

{{-- Hero Section: Split Geometris --}}
<div class="pc-hero">
    <div class="pc-hero-photo">
        <img src="{{ asset('image/cat_illustration.svg') }}" alt="PawCare">
    </div>
    <div class="container content">
        <div class="col-md-6">
            <span class="eyebrow">🐾 Selamat Datang di PawCare</span>
            <h1>Temukan <span>Sahabat</span><br>Berbulu Impianmu</h1>
            <p>Kucing terbaik dan produk berkualitas untuk keluarga barumu, siap direservasi dengan penuh cinta.</p>
            <div class="btns d-flex gap-2">
                <a href="{{ route('cats.index') }}" class="pc-btn-yellow">Lihat Kucing</a>
                <a href="{{ route('products.index') }}" class="pc-btn-outline-hero">Belanja Produk</a>
            </div>
        </div>
    </div>
</div>

<div class="container">

    {{-- 4 Fitur, overlap ke hero --}}
    <div class="pc-feature-row">
        <div class="pc-feature-card">
            <i class="bi bi-shield-check"></i>
            <div>
                <div class="t">Sehat & Terawat</div>
                <div class="d">Dirawat dengan baik</div>
            </div>
        </div>
        <div class="pc-feature-card">
            <i class="bi bi-star"></i>
            <div>
                <div class="t">Kualitas Terbaik</div>
                <div class="d">Produk pilihan</div>
            </div>
        </div>
        <div class="pc-feature-card">
            <i class="bi bi-truck"></i>
            <div>
                <div class="t">Bayar di Tempat</div>
                <div class="d">COD praktis</div>
            </div>
        </div>
        <div class="pc-feature-card">
            <i class="bi bi-clock"></i>
            <div>
                <div class="t">Reservasi Online</div>
                <div class="d">Kapan saja</div>
            </div>
        </div>
    </div>

    {{-- Kucing Pilihan --}}
    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <h4 class="pc-section-title mb-0">Kucing Pilihan</h4>
        <a href="{{ route('cats.index') }}" class="small text-decoration-none fw-bold" style="color: var(--pc-green);">Lihat Semua &rarr;</a>
    </div>
    <div class="row g-3 mb-5">
        @forelse ($cats as $cat)
            <div class="col-md-3 col-6">
                <div class="pc-card h-100">
                    <div class="pc-img-wrap">
                        @if ($cat->photo)
                            <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <span class="text-muted small">Tidak ada foto</span>
                            </div>
                        @endif
                        <span class="pc-badge">Available</span>
                        <form action="{{ route('favorites.store') }}" method="POST" class="pc-fav-form">
                            @csrf
                            <input type="hidden" name="favoritable_id" value="{{ $cat->id }}">
                            <input type="hidden" name="favoritable_type" value="cat">
                            <button type="submit" class="pc-fav-btn" title="Tambah ke wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </form>
                    </div>
                    <div class="pc-body">
                        <p class="pc-meta mb-1">{{ $cat->breed }} &bull; {{ $cat->gender === 'jantan' ? 'Jantan' : 'Betina' }}</p>
                        <div class="pc-name">{{ $cat->name }}</div>
                        <div class="pc-price">Rp {{ number_format($cat->price, 0, ',', '.') }}</div>
                        <a href="{{ route('cats.show', $cat->id) }}" class="pc-btn text-decoration-none">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Semua kucing sedang direservasi, cek lagi nanti ya! 🐱</p>
        @endforelse
    </div>

    {{-- Produk Terlaris --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="pc-section-title mb-0">Produk Terlaris</h4>
        <a href="{{ route('products.index') }}" class="small text-decoration-none fw-bold" style="color: var(--pc-green);">Lihat Semua &rarr;</a>
    </div>
    <div class="row g-3 mb-5">
        @forelse ($products as $product)
            <div class="col-md-3 col-6">
                <div class="pc-card h-100">
                    <div class="pc-img-wrap">
                        @if ($product->photo)
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <span class="text-muted small">Tidak ada foto</span>
                            </div>
                        @endif
                    </div>
                    <div class="pc-body">
                        <p class="pc-meta mb-1">{{ $product->category }}</p>
                        <div class="pc-name">{{ $product->name }}</div>
                        <div class="pc-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="{{ route('products.show', $product->id) }}" class="pc-btn text-decoration-none">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Produk akan segera hadir, cek lagi nanti ya! 🛍️</p>
        @endforelse
    </div>

    {{-- Profil PawCare (About) --}}
    <div class="row align-items-center g-4 mb-5">
        <div class="col-md-5">
            <img src="{{ asset('image/home.png') }}" alt="PawCare Cat Care Center" class="rounded-4 shadow-sm" style="width: 100%; max-height: 320px; object-fit: cover;">
        </div>
        <div class="col-md-7">
            <span class="badge mb-2" style="background-color: var(--pc-yellow); color: var(--pc-navy);">Tentang Kami</span>
            <h4 class="pc-section-title mb-3">Profil PawCare Cat Care Center</h4>
            <p class="text-muted mb-4">
                PawCare Cat Care Center berdedikasi untuk memberikan perawatan terbaik bagi kucing kesayangan Anda.
                Kami menyediakan kucing berkualitas, produk terbaik, serta layanan reservasi dan pembelian yang
                mudah dan cepat, lengkap dengan pembayaran COD (Cash on Delivery) yang praktis.
            </p>
            <div class="d-flex gap-4">
                <div>
                    <h5 class="fw-bold mb-0" style="color: var(--pc-green);">100+</h5>
                    <p class="small text-muted mb-0">Kucing Terawat</p>
                </div>
                <div>
                    <h5 class="fw-bold mb-0" style="color: var(--pc-green);">500+</h5>
                    <p class="small text-muted mb-0">Pelanggan Puas</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection