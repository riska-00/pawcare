
@extends('layouts.app')

@section('title', 'Tentang Kami - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&display=swap" rel="stylesheet">


<style>
    :root {
        --ab-green: #128965;
        --ab-green-dark: #0e6e51;
        --ab-yellow: #FFD85C;
        --ab-navy: #2A324C;
        --ab-coral: #EC5D5D;
        --ab-cream: #FFFAE8;
        --ab-border: #EFE6C0;
    }

    * {
        box-sizing: border-box;
    }

    .about-page {
        background: var(--ab-cream);
        color: var(--ab-navy);
        overflow: hidden;
    }

    .ab-baloo {
        font-family: 'Baloo 2', sans-serif;
    }

    
    
    /* HERO TENTANG KAMI */
    .ab-hero {
        position: relative;
        min-height: 410px;
        padding: 55px 24px;
        background: linear-gradient(
            115deg,
            #EAF5E5 0%,
            #FFFAE8 55%,
            #FFF0D6 100%
        );
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }

    /* Dekorasi lingkaran */
    .ab-hero::before {
        content: "";
        position: absolute;
        width: 145px;
        height: 145px;
        border-radius: 50%;
        background: #F8E59B;
        top: 30px;
        left: 6%;
    }

    .ab-hero::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(18, 137, 101, .13);
        bottom: 25px;
        right: 10%;
    }

    /* Konten hero */
    .ab-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 850px;
        margin: 0 auto;
    }

    /* Label */
    .ab-hero-label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #FFFFFF;
        border: 2px solid #2A324C;
        color: #2A324C;
        border-radius: 30px;
        padding: 6px 18px;
        font-size: .78rem;
        font-weight: 800;
        margin-bottom: 18px;
    }

    /* Judul */
    .ab-hero h1 {
        font-family: 'Baloo 2', sans-serif;
        font-size: clamp(2.2rem, 4vw, 3rem);
        font-weight: 800;
        line-height: 1.15;
        color: #2A324C;
        margin: 0 0 14px;
    }

    .ab-hero h1 span {
        color: #128965;
    }

    /* Deskripsi */
    .ab-hero p {
        font-size: .98rem;
        line-height: 1.7;
        color: #626879;
        max-width: 600px;
        margin: 0 auto 25px;
    }

    /* Tiga label */
    .ab-hero-features {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .ab-hero-feature {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-width: 170px;
        padding: 11px 17px;
        background: #FFFFFF;
        border: 2px solid #2A324C;
        border-radius: 15px;
        color: #2A324C;
        font-size: .85rem;
        font-weight: 800;
    }

    .ab-hero-feature i {
        font-size: 1.15rem;
        color: #128965;
        flex-shrink: 0;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .ab-hero {
            min-height: 380px;
            padding: 50px 20px;
        }

        .ab-hero::before {
            width: 100px;
            height: 100px;
            left: -30px;
        }

        .ab-hero::after {
            width: 75px;
            height: 75px;
            right: -20px;
        }

        .ab-hero h1 {
            font-size: 2.3rem;
        }

        .ab-hero p {
            font-size: .9rem;
        }

        .ab-hero-feature {
            min-width: 0;
            padding: 10px 13px;
            font-size: .78rem;
        }
    }

    @media (max-width: 480px) {
        .ab-hero h1 {
            font-size: 2rem;
        }

        .ab-hero-feature {
            width: 100%;
            max-width: 270px;
        }
    }

    /* =========================
       CERITA KAMI
    ========================= */

    .ab-section {
        padding: 75px 0;
    }

    .ab-section-label {
        display: inline-block;
        color: var(--ab-green);
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .ab-section-title {
        font-family: 'Baloo 2', sans-serif;
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 800;
        line-height: 1.25;
        color: var(--ab-navy);
        margin-bottom: 20px;
    }

    .ab-section-title span {
        color: var(--ab-green);
    }

    .ab-intro-grid {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 65px;
        align-items: center;
    }

    .ab-intro-text p {
        color: #626879;
        font-size: .96rem;
        line-height: 1.95;
        margin-bottom: 18px;
    }

    .ab-intro-highlight {
        border-left: 4px solid var(--ab-yellow);
        padding: 12px 20px;
        margin-top: 25px;
        background: #FFF3C8;
        border-radius: 0 12px 12px 0;
        color: var(--ab-navy);
        font-weight: 600;
        line-height: 1.8;
    }

    /* =========================
       SEKILAS PAWCARE
    ========================= */

    .ab-facts {
        background: #FFFFFF;
        border: 1px solid var(--ab-border);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 12px 35px rgba(42, 50, 76, .05);
    }

    .ab-facts-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
    }

    .ab-facts-icon {
        width: 52px;
        height: 52px;
        flex-shrink: 0;
        border-radius: 15px;
        background: #E4F6ED;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }

    .ab-facts h3 {
        font-family: 'Baloo 2', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        margin: 0;
    }

    .ab-facts-header p {
        color: #888C98;
        font-size: .8rem;
        margin: 0;
    }

    .ab-fact-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 17px 0;
        border-bottom: 1px dashed var(--ab-border);
        font-size: .92rem;
        gap: 12px;
    }

    .ab-fact-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .ab-fact-row strong {
        color: var(--ab-green);
        font-family: 'Baloo 2', sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
    }

    /* =========================
       MENGAPA PAWCARE
    ========================= */

    .ab-benefits {
        background: #FFF4D1;
        padding: 60px 0;
    }

    .ab-center {
        text-align: center;
    }

    .about-page .ab-benefits-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-top: 30px;
    }

    .ab-benefit-card {
        background: #FFFFFF;
        border: 1px solid var(--ab-border);
        border-radius: 16px;
        padding: 22px 15px;
        min-width: 0;
        text-align: center;
        transition: transform .25s, box-shadow .25s;
    }

    .ab-benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(42, 50, 76, .08);
    }

    .ab-benefit-icon {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        background: #E9F7EE;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        font-size: 1.6rem;
    }

    .ab-benefit-card:nth-child(2) .ab-benefit-icon {
        background: #FFF2CA;
    }

    .ab-benefit-card:nth-child(3) .ab-benefit-icon {
        background: #FFE8DB;
    }

    .ab-benefit-card:nth-child(4) .ab-benefit-icon {
        background: #E8F1FF;
    }

    .ab-benefit-card h4 {
        font-family: 'Baloo 2', sans-serif;
        font-size: 1rem;
        font-weight: 800;
        color: var(--ab-navy);
        margin-bottom: 8px;
    }

    .ab-benefit-card p {
        font-size: .82rem;
        line-height: 1.6;
        color: #777D89;
        margin: 0;
    }

    /* =========================
       CTA
    ========================= */

    .ab-cta-section {
        padding: 75px 0;
    }

    .ab-cta {
        background: var(--ab-green);
        border-radius: 28px;
        padding: 55px 30px;
        text-align: center;
        color: #FFFFFF;
        position: relative;
        overflow: hidden;
    }

    .ab-cta::before,
    .ab-cta::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
        pointer-events: none;
    }

    .ab-cta::before {
        top: -110px;
        left: -80px;
    }

    .ab-cta::after {
        bottom: -140px;
        right: -50px;
    }

    .ab-cta-content {
        position: relative;
        z-index: 1;
    }

    .ab-cta h2 {
        font-family: 'Baloo 2', sans-serif;
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 800;
        margin-bottom: 12px;
    }

    .ab-cta p {
        max-width: 520px;
        margin: 0 auto 28px;
        color: #E1F7ED;
        line-height: 1.8;
        font-size: .95rem;
    }

    .ab-cta-actions {
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .ab-btn {
        display: inline-block;
        padding: 13px 30px;
        border-radius: 30px;
        font-weight: 800;
        text-decoration: none;
        font-size: .9rem;
        transition: transform .2s;
    }

    .ab-btn:hover {
        transform: translateY(-3px);
    }

    .ab-btn-yellow {
        background: var(--ab-yellow);
        color: var(--ab-navy);
    }

    .ab-btn-outline {
        background: transparent;
        color: #FFFFFF;
        border: 2px solid rgba(255, 255, 255, .8);
    }

    /* =========================
       RESPONSIVE TABLET
    ========================= */

    @media (max-width: 992px) {
        .ab-intro-grid {
            grid-template-columns: 1fr;
            gap: 35px;
        }

        .about-page .ab-benefits-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* =========================
       RESPONSIVE MOBILE
    ========================= */

    @media (max-width: 576px) {
        .ab-hero {
            min-height: 290px;
            padding: 50px 20px 75px;
        }

        .ab-hero h1 {
            font-size: 2.3rem;
        }

        .ab-hero p {
            font-size: .88rem;
        }

        .ab-paw-left {
            left: 5%;
            top: 40px;
        }

        .ab-paw-right {
            right: 5%;
            top: 45px;
        }

        .ab-paw-small {
            display: none;
        }

        .ab-hero-wave {
            height: 60px;
        }

        .ab-section,
        .ab-cta-section {
            padding: 45px 0;
        }

        .ab-benefits {
            padding: 50px 0;
        }

        .about-page .ab-benefits-grid {
            grid-template-columns: 1fr;
        }

        .ab-facts {
            padding: 24px;
        }

        .ab-cta {
            padding: 40px 20px;
        }
    }
</style>
@endsection

@section('content')

<div class="about-page">

    
<!-- HERO TENTANG KAMI -->
<section class="ab-hero">

    <div class="ab-hero-content">

        <!-- Label -->
        <div class="ab-hero-label">
            🐾 Tentang Kami
        </div>

        <!-- Judul -->
        <h1>
            Kenali <span>PawCare</span><br>
            Lebih Dekat
        </h1>

        <!-- Deskripsi -->
        <p>
            Mengenal cerita dan komitmen kami dalam
            memberikan yang terbaik untuk sahabat berbulu.
        </p>

        <div class="ab-hero-features">

        <div class="ab-hero-feature">
                <i class="bi bi-shield-check"></i>
                <span>Sehat & Terawat</span>
            </div>

            <div class="ab-hero-feature">
                <i class="bi bi-star"></i>
                <span>Kualitas Terbaik</span>
            </div>

            <div class="ab-hero-feature">
                <i class="bi bi-truck"></i>
                <span>Bayar di Tempat</span>
            </div>

            <div class="ab-hero-feature">
                <i class="bi bi-clock"></i>
                <span>Reservasi Online</span>
            </div>

        </div>
</section>

    <!-- TENTANG KAMI -->
    <section class="ab-section">
        <div class="container">

            <div class="ab-intro-grid">

                <div class="ab-intro-text">

                    <span class="ab-section-label">
                        CERITA KAMI
                    </span>

                    <h2 class="ab-section-title">
                        Karena Setiap Kucing
                        <span>Berhak Disayangi.</span>
                    </h2>

                    <p>
                        PawCare Cat Care Center hadir sebagai
                        tempat yang membantu Anda menemukan
                        sahabat berbulu sekaligus memenuhi
                        berbagai kebutuhan kucing kesayangan.
                        Kami percaya bahwa setiap kucing
                        berhak mendapatkan rumah yang penuh
                        kasih sayang dan perawatan terbaik.
                    </p>

                    <p>
                        Kami menyediakan kucing-kucing yang
                        terawat dengan baik serta beragam
                        produk berkualitas untuk kebutuhan
                        sehari-hari. Melalui sistem reservasi
                        dan pembelian online yang mudah,
                        dilengkapi pembayaran COD, kami
                        berkomitmen memberikan pengalaman
                        yang nyaman dan praktis bagi
                        setiap pelanggan.
                    </p>

                </div>

                <div class="ab-facts">

                    <div class="ab-facts-header">

                        <div class="ab-facts-icon">
                            🐾
                        </div>

                        <div>
                            <h3>Sekilas PawCare</h3>
                            <p>
                                Lebih dekat dengan layanan kami
                            </p>
                        </div>

                    </div>

                    <div class="ab-fact-row">
                        <span>🐱 Kucing Terawat</span>
                        <strong>100+</strong>
                    </div>

                    <div class="ab-fact-row">
                        <span>💚 Pelanggan Puas</span>
                        <strong>500+</strong>
                    </div>

                    <div class="ab-fact-row">
                        <span>📅 Reservasi Online</span>
                        <strong>24/7</strong>
                    </div>

                    <div class="ab-fact-row">
                        <span>🚚 Metode Pembayaran</span>
                        <strong>COD</strong>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section class="ab-benefits">
        <div class="container">

            <div class="ab-center">

                <span class="ab-section-label">
                    MENGAPA PAWCARE?
                </span>

                <h2 class="ab-section-title">
                    Yang Terbaik untuk
                    <span>Sahabat Berbulu</span>
                </h2>

            </div>

            <div class="ab-benefits-grid">

                <div class="ab-benefit-card">
                    <div class="ab-benefit-icon">
                        🛡️
                    </div>

                    <h4>Kucing Terawat</h4>

                    <p>
                        Kucing mendapatkan perhatian
                        dan perawatan yang baik.
                    </p>
                </div>

                <div class="ab-benefit-card">
                    <div class="ab-benefit-icon">
                        ⭐
                    </div>

                    <h4>Produk Berkualitas</h4>

                    <p>
                        Beragam produk pilihan untuk
                        memenuhi kebutuhan kucing Anda.
                    </p>
                </div>

                <div class="ab-benefit-card">
                    <div class="ab-benefit-icon">
                        🚚
                    </div>

                    <h4>Pembayaran Praktis</h4>

                    <p>
                        Nikmati kemudahan berbelanja
                        dengan metode pembayaran COD.
                    </p>
                </div>

                <div class="ab-benefit-card">
                    <div class="ab-benefit-icon">
                        📅
                    </div>

                    <h4>Reservasi Online</h4>

                    <p>
                        Temukan dan reservasi kucing
                        pilihan Anda dengan mudah.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- CTA -->
    <section class="ab-cta-section">
        <div class="container">

            <div class="ab-cta">

                <div class="ab-cta-content">

                    <h2>
                        Siap Menemukan Sahabat Barumu?
                    </h2>

                    <p>
                        Temukan kucing yang tepat untuk
                        menjadi bagian dari keluarga Anda
                        dan lengkapi kebutuhannya bersama
                        PawCare.
                    </p>

                    <div class="ab-cta-actions">

                        <a
                            href="{{ route('cats.index') }}"
                            class="ab-btn ab-btn-yellow"
                        >
                            Jelajahi Kucing
                        </a>

                        <a
                            href="{{ route('products.index') }}"
                            class="ab-btn ab-btn-outline"
                        >
                            Lihat Produk
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </section>

</div>

@endsection