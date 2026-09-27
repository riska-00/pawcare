
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
        min-height: 330px;
        background: linear-gradient(135deg, #FFFAE8, #FFF3C8);
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        overflow: hidden;
        padding: 55px 20px 85px;
    }

    .ab-hero-content {
        position: relative;
        z-index: 2;
        max-width: 750px;
        margin: auto;
    }

    .ab-hero-label {
        display: inline-block;
        background: #FFE49A;
        color: #0e6e51;
        padding: 7px 20px;
        border-radius: 30px;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }

    .ab-hero h1 {
        font-family: 'Baloo 2', sans-serif;
        color: #128965;
        font-size: clamp(2.5rem, 5vw, 3.7rem);
        font-weight: 800;
        line-height: 1.1;
        margin: 0 0 16px;
    }

    .ab-hero h1 span {
        color: #174F3C;
    }

    .ab-hero p {
        font-size: 1rem;
        color: #626879;
        margin: 0;
    }

    /* DEKORASI */
    .ab-paw {
        position: absolute;
        color: #F3BD45;
        opacity: .85;
        z-index: 1;
    }

    .ab-paw-left {
        top: 65px;
        left: 19%;
        transform: rotate(-20deg);
    }

    .ab-paw-right {
        top: 70px;
        right: 15%;
        transform: rotate(25deg);
    }

    .ab-paw-small {
        bottom: 95px;
        right: 25%;
        transform: rotate(-15deg);
    }

    /* GELOMBANG */
    .ab-hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 95px;
        z-index: 1;
    }

    .ab-hero-wave svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    
    /* RESPONSIVE */
    @media (max-width: 992px) {
        .ab-intro-grid {
            grid-template-columns: 1fr;
            gap: 35px;
        }

        .ab-benefits-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 576px) {
        .ab-section,
        .ab-cta-section {
            padding: 45px 0;
        }

        .ab-benefits {
            padding: 50px 0;
        }

        .ab-benefits-grid {
            grid-template-columns: 1fr;
        }

        .ab-facts {
            padding: 24px;
        }

        .ab-cta {
            padding: 40px 20px;
        }
    }

    /* INTRO */
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

    /* FAKTA */
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

    /* KEUNGGULAN */
    .ab-benefits {
        background: #FFF4D1;
        padding: 70px 0;
    }

    .ab-center {
        text-align: center;
    }

    
    .ab-benefits-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-top: 30px;
    }

    .ab-benefit-card {
        background: #fff;
        border: 1px solid #EFE6C0;
        border-radius: 16px;
        padding: 20px 15px;
        text-align: center;
    }

    .ab-benefit-icon {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }

    .ab-benefit-card h4 {
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .ab-benefit-card p {
        font-size: .82rem;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 992px) {
        .ab-benefits-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    .ab-benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(42, 50, 76, .08);
    }

    .ab-benefit-icon {
        width: 68px;
        height: 68px;
        border-radius: 20px;
        background: #E9F7EE;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
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
        font-size: 1.15rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .ab-benefit-card p {
        font-size: .85rem;
        line-height: 1.8;
        color: #777D89;
        margin: 0;
    }

    /* CTA */
    .ab-cta-section {
        padding: 75px 0;
    }

    .ab-cta {
        background: var(--ab-green);
        border-radius: 28px;
        padding: 55px 30px;
        text-align: center;
        color: white;
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
        color: white;
        border: 2px solid rgba(255, 255, 255, .8);
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .ab-intro-grid {
            grid-template-columns: 1fr;
            gap: 35px;
        }

        .ab-benefits-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

        .ab-paw {
        position: absolute;
        color: #F3BD45;
        font-size: 2rem;
        opacity: .85;
        z-index: 1;
    }

        .ab-section,
        .ab-cta-section {
            padding: 45px 0;
    }

        .ab-benefits {
            padding: 50px 0;
    }

        .ab-benefits-grid {
            grid-template-columns: 1fr;
    }

        .ab-facts {
            padding: 24px;
    }

        .ab-cta {
            padding: 40px 20px;
    }

</style>
@endsection

@section('content')

<div class="about-page">

    <!-- HERO TENTANG KAMI -->
    <section class="ab-hero">

        <!-- Dekorasi jejak kaki -->
        <div class="ab-paw ab-paw-left">
            🐾
        </div>

        <div class="ab-paw ab-paw-right">
            🐾
        </div>

        <div class="ab-paw ab-paw-small">
            🐾
        </div>

        <!-- Konten hero -->
        <div class="ab-hero-content">

            <span class="ab-hero-label">
                TENTANG KAMI
            </span>

            <h1>
                Kenali PawCare<br>
                <span>Lebih Dekat</span>
            </h1>

            <p>
                Rumah penuh kasih untuk sahabat berbulu Anda.
            </p>

        </div>

        <!-- Gelombang dekoratif -->
        <div class="ab-hero-wave">
            <svg
                viewBox="0 0 1440 100"
                preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >
                <!-- Gelombang kuning -->
                <path
                    d="M0,45 C220,5 300,110 540,65
                    C780,20 880,110 1100,45
                    C1250,0 1350,50 1440,35
                    L1440,100 L0,100 Z"
                    fill="#FFE49A"
                />

                <!-- Gelombang hijau kiri dan kanan -->
                <path
                    d="M0,30 C100,20 160,45 240,75
                    L0,100 Z"
                    fill="#128965"
                />

                <path
                    d="M1100,65 C1240,10 1330,20 1440,40
                    L1440,100 Z"
                    fill="#128965"
                />

                <!-- Transisi ke bagian konten -->
                <path
                    d="M0,75 C220,115 350,65 540,82
                    C750,100 850,65 1050,78
                    C1250,95 1350,65 1440,80
                    L1440,100 L0,100 Z"
                    fill="#FFFAE8"
                />
            </svg>
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