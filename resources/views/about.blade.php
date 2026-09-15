@extends('layouts.app')

@section('title', 'Tentang Kami - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --ab-green:#128965; --ab-green-dark:#0e6e51; --ab-yellow:#FFD85C; --ab-navy:#2A324C; --ab-coral:#EC5D5D; --ab-cream:#FFFAE8; }
    .ab-baloo{ font-family:'Baloo 2',sans-serif; }

    .ab-hero{ position:relative; padding:60px 0 50px; overflow:hidden;
        background: radial-gradient(circle at 12% 20%, rgba(18,137,101,.16) 0%, transparent 35%),
                    radial-gradient(circle at 88% 15%, rgba(255,216,92,.35) 0%, transparent 32%),
                    var(--ab-cream);
    }
    .ab-hero::after{content:"";position:absolute;left:0;right:0;bottom:0;height:60px;background:linear-gradient(to bottom, transparent, var(--ab-cream));}
    .ab-blob{position:absolute;border-radius:50%;opacity:.5;}
    .ab-b1{width:130px;height:130px;background:var(--ab-yellow);top:10px;left:8%;}
    .ab-b2{width:90px;height:90px;background:var(--ab-green);opacity:.18;bottom:0;right:10%;}
    .ab-hero h1{font-size:2.4rem;font-weight:800;color:var(--ab-navy);}
    .ab-hero h1 span{color:var(--ab-green);}
    .ab-hero p{color:#5b5f6b;max-width:520px;margin:0 auto;font-family:-apple-system,sans-serif;}

    .ab-story-img{border-radius:20px;width:100%;height:320px;object-fit:cover;}
    .ab-story-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--ab-navy);font-size:1.6rem;margin-bottom:14px;}
    .ab-story-text{color:#5b5f6b;line-height:1.7;margin-bottom:16px;}

    .ab-value-card{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:24px;height:100%;text-align:center;}
    .ab-value-card i{font-size:1.8rem;color:var(--ab-green);margin-bottom:12px;}
    .ab-value-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--ab-navy);font-size:1rem;margin-bottom:6px;}
    .ab-value-desc{color:#707378;font-size:.85rem;line-height:1.5;}

    .ab-stat-strip{display:flex;justify-content:center;background:#fff;border-radius:20px;overflow:hidden;border:1px solid #EFE6C0;}
    .ab-stat-item{flex:1;text-align:center;padding:28px 16px;border-right:1px solid #EFE6C0;}
    .ab-stat-item:last-child{border-right:none;}
    .ab-stat-num{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.9rem;color:var(--ab-green);}
    .ab-stat-label{font-size:.82rem;color:#707378;}

    .ab-cta{background:var(--ab-green);border-radius:20px;padding:40px;text-align:center;color:#fff;position:relative;overflow:hidden;}
    .ab-cta::before{content:"";position:absolute;width:180px;height:180px;background:rgba(255,255,255,.08);border-radius:50%;top:-50px;right:-50px;}
    .ab-cta h3{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.5rem;margin-bottom:10px;}
    .ab-cta p{color:#DCF4EA;max-width:440px;margin:0 auto 22px;font-size:.92rem;}
    .ab-cta-btn{background:var(--ab-yellow);color:var(--ab-navy);padding:11px 28px;border-radius:30px;font-weight:700;text-decoration:none;display:inline-block;font-size:.9rem;}

    .ab-section-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--ab-navy);text-align:center;margin-bottom:8px;}
    .ab-section-sub{text-align:center;color:#707378;font-size:.9rem;margin-bottom:32px;}
</style>
@endsection

@section('content')

<div class="ab-hero text-center">
    <div class="ab-blob ab-b1"></div><div class="ab-blob ab-b2"></div>
    <div class="container position-relative ab-baloo">
        <h1>Tentang <span>PawCare</span></h1>
        <p style="font-family:-apple-system,sans-serif;">Cerita di balik dedikasi kami untuk kucing dan pemiliknya.</p>
    </div>
</div>

<div class="container py-5">

    {{-- CERITA KAMI --}}
    <div class="row align-items-center g-4 mb-5">
        <div class="col-md-5">
            <img src="{{ asset('image/home.png') }}" alt="PawCare Cat Care Center" class="ab-story-img">
        </div>
        <div class="col-md-7">
            <div class="ab-story-title ab-baloo">Cerita Kami</div>
            <p class="ab-story-text">
                PawCare Cat Care Center berdedikasi untuk memberikan perawatan terbaik bagi kucing kesayangan Anda.
                Kami percaya setiap kucing berhak mendapatkan rumah yang penuh kasih sayang, dan setiap pemiliknya
                berhak mendapatkan kemudahan dalam merawat sahabat berbulu mereka.
            </p>
            <p class="ab-story-text">
                Sejak awal berdiri, kami fokus menghadirkan kucing-kucing berkualitas yang dirawat dengan baik,
                produk-produk terbaik untuk kebutuhan harian, serta layanan reservasi dan pembelian yang mudah,
                lengkap dengan pembayaran COD yang praktis.
            </p>
        </div>
    </div>

    {{-- NILAI KAMI --}}
    <div class="ab-section-title">Kenapa Memilih Kami?</div>
    <div class="ab-section-sub">Komitmen kami dalam setiap layanan</div>
    <div class="row g-3 mb-5">
        <div class="col-md-3 col-6">
            <div class="ab-value-card">
                <i class="bi bi-shield-check"></i>
                <div class="ab-value-title ab-baloo">Kucing Sehat</div>
                <div class="ab-value-desc">Dirawat dengan baik sebelum sampai ke tangan Anda</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="ab-value-card">
                <i class="bi bi-star"></i>
                <div class="ab-value-title ab-baloo">Kualitas Terbaik</div>
                <div class="ab-value-desc">Produk pilihan untuk kebutuhan si kucing</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="ab-value-card">
                <i class="bi bi-truck"></i>
                <div class="ab-value-title ab-baloo">Bayar di Tempat</div>
                <div class="ab-value-desc">Transaksi COD yang aman dan praktis</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="ab-value-card">
                <i class="bi bi-clock"></i>
                <div class="ab-value-title ab-baloo">Reservasi Online</div>
                <div class="ab-value-desc">Kapan saja, tanpa perlu antre</div>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="ab-stat-strip mb-5">
        <div class="ab-stat-item"><div class="ab-stat-num">100+</div><div class="ab-stat-label">Kucing Terawat</div></div>
        <div class="ab-stat-item"><div class="ab-stat-num">500+</div><div class="ab-stat-label">Pelanggan Puas</div></div>
        <div class="ab-stat-item"><div class="ab-stat-num">24/7</div><div class="ab-stat-label">Reservasi Online</div></div>
    </div>

    {{-- CTA --}}
    <div class="ab-cta ab-baloo">
        <h3>Siap Menemukan Sahabat Barumu?</h3>
        <p style="font-family:-apple-system,sans-serif;">Jelajahi koleksi kucing dan produk kami sekarang.</p>
        <div class="d-flex gap-2 justify-content-center flex-wrap">
            <a href="{{ route('cats.index') }}" class="ab-cta-btn">Lihat Kucing</a>
        </div>
    </div>

</div>

@endsection