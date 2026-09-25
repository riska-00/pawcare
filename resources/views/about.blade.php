@extends('layouts.app')

@section('title', 'Tentang Kami - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --ab-green:#128965; --ab-green-dark:#0e6e51; --ab-yellow:#FFD85C; --ab-navy:#2A324C; --ab-coral:#EC5D5D; --ab-cream:#FFFAE8; }
    .ab-baloo{ font-family:'Baloo 2',sans-serif; }

    /* Hero — samain gaya sama home & katalog kucing */
    .ab-hero{ position:relative; padding:60px 0 70px; overflow:hidden;
        background: radial-gradient(circle at 12% 18%, rgba(18,137,101,.16) 0%, transparent 35%),
                    radial-gradient(circle at 88% 12%, rgba(255,216,92,.35) 0%, transparent 32%),
                    radial-gradient(circle at 90% 85%, rgba(236,93,93,.14) 0%, transparent 30%),
                    var(--ab-cream);
    }
    .ab-hero::after{content:"";position:absolute;left:0;right:0;bottom:0;height:70px;background:linear-gradient(to bottom, transparent, var(--ab-cream));}
    .ab-blob{position:absolute;border-radius:50%;opacity:.55;}
    .ab-b1{width:150px;height:150px;background:var(--ab-yellow);top:10px;left:6%;}
    .ab-b2{width:100px;height:100px;background:var(--ab-green);opacity:.18;bottom:10px;right:10%;}
    .ab-label-tag{display:inline-block;padding:4px 14px;border-radius:20px;background:#fff;border:2px solid var(--ab-navy);font-weight:700;font-size:.72rem;margin-bottom:14px;color:var(--ab-navy);}
    .ab-hero h1{font-size:2.6rem;font-weight:800;color:var(--ab-navy);}
    .ab-hero h1 span{color:var(--ab-green);}
    .ab-hero p{color:#5b5f6b;font-size:1.02rem;max-width:480px;margin:0 auto 28px;font-family:-apple-system,sans-serif;}

    /* Timeline */
    .ab-tl{max-width:560px;margin:0 auto;}
    .ab-tl-row{display:flex;gap:18px;}
    .ab-tl-dot-col{width:16px;display:flex;flex-direction:column;align-items:center;flex-shrink:0;}
    .ab-tl-dot{width:16px;height:16px;border-radius:50%;flex-shrink:0;}
    .ab-tl-line{width:2px;flex:1;background:#DCD3B2;min-height:50px;}
    .ab-tl-card{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:18px 20px;margin-bottom:18px;flex:1;}
    .ab-tl-card h4{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--ab-navy);font-size:1rem;margin-bottom:6px;}
    .ab-tl-card p{margin:0;font-size:.88rem;color:#5b5f6b;line-height:1.6;}

    .ab-section-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--ab-navy);text-align:center;margin-bottom:8px;}
    .ab-section-sub{text-align:center;color:#707378;font-size:.9rem;margin-bottom:32px;}

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

    .ab-hero-stats{display:flex;justify-content:center;gap:14px;flex-wrap:wrap;}
    .ab-hero-stat{background:#fff;border:2px solid var(--ab-navy);border-radius:16px;padding:10px 18px;display:flex;align-items:center;gap:8px;}
    .ab-hero-stat b{font-family:'Baloo 2',sans-serif;color:var(--ab-green);font-size:1rem;}
    .ab-hero-stat span{font-size:.78rem;color:var(--ab-navy);font-weight:600;}
</style>
@endsection

@section('content')

<div class="ab-hero text-center">
    <div class="ab-blob ab-b1"></div><div class="ab-blob ab-b2"></div>
    <div class="container position-relative">
        <span class="ab-label-tag">🐾 Tentang Kami</span>
        <h1 class="ab-baloo">Kenalan Lebih Dekat<br>dengan <span>PawCare</span></h1>
        <p>Cerita di balik dedikasi kami untuk kucing dan pemiliknya.</p>
        <div class="ab-hero-stats">
            <div class="ab-hero-stat"><b>100+</b><span>Kucing Terawat</span></div>
            <div class="ab-hero-stat"><b>500+</b><span>Pelanggan Puas</span></div>
            <div class="ab-hero-stat"><b>24/7</b><span>Reservasi</span></div>
        </div>
    </div>
</div>

<div class="container py-5">

    {{-- TIMELINE CERITA --}}
    <div class="ab-tl mb-5">
        <div class="ab-tl-row">
            <div class="ab-tl-dot-col"><div class="ab-tl-dot" style="background:var(--ab-green)"></div><div class="ab-tl-line"></div></div>
            <div class="ab-tl-card">
                <h4>🐾 Awal Mula</h4>
                <p>PawCare berdiri dari kecintaan pada kucing dan keinginan memberi setiap kucing rumah yang penuh kasih sayang.</p>
            </div>
        </div>
        <div class="ab-tl-row">
            <div class="ab-tl-dot-col"><div class="ab-tl-dot" style="background:var(--ab-yellow)"></div><div class="ab-tl-line"></div></div>
            <div class="ab-tl-card">
                <h4>💚 Misi Kami</h4>
                <p>Menghadirkan kucing sehat dan terawat, produk berkualitas untuk kebutuhan harian, serta layanan reservasi dan pembelian yang mudah, lengkap dengan pembayaran COD yang praktis.</p>
            </div>
        </div>
        <div class="ab-tl-row">
            <div class="ab-tl-dot-col"><div class="ab-tl-dot" style="background:var(--ab-green)"></div></div>
            <div class="ab-tl-card" style="margin-bottom:0;">
                <h4>🏆 PawCare Sekarang</h4>
                <p>100+ kucing terawat, 500+ pelanggan puas, dan reservasi online yang bisa dilakukan kapan saja.</p>
            </div>
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