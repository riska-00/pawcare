@extends('layouts.app')

@section('title', 'Beranda - PawCare')

@section('content')

<div class="pt-5 pb-3" style="background-color: #FFFAE8;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-1 fs-5" style="color: #2A324C;">Selamat Datang di</p>
                <h1 class="fw-bold mb-3" style="font-size: 3.2rem;">
                    <span style="color: #FFD85C;">Paw</span><span style="color: #128965;">Care</span> 🐾
                </h1>
                <p class="text-muted mb-4 fs-5">Temukan kucing terbaik dan produk berkualitas untuk sahabat berbulu Anda.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('cats.index') }}" class="btn btn-pawcare px-4 py-2">🐾 Lihat Kucing</a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-success px-4 py-2">🛍️ Belanja Produk</a>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <img src="{{ asset('image/hero_cat.png') }}" alt="PawCare" class="img-fluid rounded-4" style="max-height: 380px; width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="card border-0 shadow-sm p-4 mb-5">
        <div class="row text-center g-4">
            <div class="col-md-3 col-6">
                <div class="mb-2" style="font-size: 1.8rem; color: #128965;"><i class="bi bi-shield-check"></i></div>
                <h6 class="fw-bold mb-1">Kucing Sehat & Terawat</h6>
                <p class="small text-muted mb-0">Kucing kami dirawat dengan baik dan sehat</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="mb-2" style="font-size: 1.8rem; color: #FFD85C;"><i class="bi bi-star"></i></div>
                <h6 class="fw-bold mb-1">Produk Berkualitas</h6>
                <p class="small text-muted mb-0">Pilihan produk terbaik untuk kucing kesayangan</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="mb-2" style="font-size: 1.8rem; color: #128965;"><i class="bi bi-truck"></i></div>
                <h6 class="fw-bold mb-1">Bayar di Tempat</h6>
                <p class="small text-muted mb-0">Pesanan diantar dan dibayar langsung (COD)</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="mb-2" style="font-size: 1.8rem; color: #FFD85C;"><i class="bi bi-clock"></i></div>
                <h6 class="fw-bold mb-1">Reservasi Online</h6>
                <p class="small text-muted mb-0">Reservasi kucing kapan saja lewat aplikasi</p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2A324C;">🐾 Kucing Pilihan</h5>
        <a href="{{ route('cats.index') }}" class="small text-decoration-none" style="color: #128965;">Lihat Semua &rarr;</a>
    </div>
    <div class="row g-3 mb-5">
        @forelse ($cats as $cat)
            <div class="col-md-3 col-6">
                <div class="card h-100 border-0 shadow-sm">
                    @if ($cat->photo)
                        <img src="{{ asset('storage/' . $cat->photo) }}" class="card-img-top" alt="{{ $cat->name }}" style="height: 160px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 160px;">
                            <span class="text-muted small">Tidak ada foto</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <span class="badge mb-2" style="background-color: #128965;">Available</span>
                        <h6 class="fw-bold mb-1">{{ $cat->breed }}</h6>
                        <p class="small mb-2" style="color: #128965;">Rp {{ number_format($cat->price, 0, ',', '.') }}</p>
                        <a href="{{ route('cats.show', $cat->id) }}" class="btn btn-sm btn-outline-secondary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Semua kucing sedang direservasi, cek lagi nanti ya! 🐱</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2A324C;">🛍️ Produk Terlaris</h5>
        <a href="{{ route('products.index') }}" class="small text-decoration-none" style="color: #128965;">Lihat Semua &rarr;</a>
    </div>
    <div class="row g-3 mb-5">
        @forelse ($products as $product)
            <div class="col-md-3 col-6">
                <div class="card h-100 border-0 shadow-sm">
                    @if ($product->photo)
                        <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 160px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 160px;">
                            <span class="text-muted small">Tidak ada foto</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                        <p class="small mb-2" style="color: #128965;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-secondary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Produk akan segera hadir, cek lagi nanti ya! 🛍️</p>
        @endforelse
    </div>

    <div class="row align-items-center g-4">
        <div class="col-md-5">
            <img src="{{ asset('image/home.png') }}" alt="PawCare Cat Care Center" class="img-fluid rounded-4 shadow-sm w-100">
        </div>
        <div class="col-md-7">
            <span class="badge mb-2" style="background-color: #FFD85C; color: #2A324C;">Tentang Kami</span>
            <h4 class="fw-bold mb-3" style="color: #2A324C;">Profil PawCare Cat Care Center</h4>
            <p class="text-muted mb-4">
                PawCare Cat Care Center berdedikasi untuk memberikan perawatan terbaik bagi kucing kesayangan Anda.
                Kami menyediakan kucing berkualitas, produk terbaik, serta layanan reservasi dan pembelian yang
                mudah dan cepat, lengkap dengan pembayaran COD (Cash on Delivery) yang praktis.
            </p>
            <div class="d-flex gap-4">
                <div>
                    <h5 class="fw-bold mb-0" style="color: #128965;">100+</h5>
                    <p class="small text-muted mb-0">Kucing Terawat</p>
                </div>
                <div>
                    <h5 class="fw-bold mb-0" style="color: #128965;">500+</h5>
                    <p class="small text-muted mb-0">Pelanggan Puas</p>
                </div>
            </div>
        </div>
    </div>
@endsection