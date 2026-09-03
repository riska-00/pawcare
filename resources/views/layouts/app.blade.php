<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'PawCare'))</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #FFFAE8;
        }

        .navbar {
            background-color: #FFD85C !important;
        }

        .navbar-brand {
            color: #128965 !important;
            font-weight: 700;
        }

        .nav-link {
            color: #2A324C !important;
        }

        .nav-link.active {
            color: #128965 !important;
            font-weight: 600;
        }

        .nav-link:hover {
            color: #128965 !important;
        }

        .btn-pawcare {
            background-color: #128965;
            color: #FFFFFF;
        }

        .btn-pawcare:hover {
            background-color: #0e6e51;
            color: #FFFFFF;
        }

        .pc-card {
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #EFE6C0;
            transition: transform .15s ease, box-shadow .15s ease;
            background-color: #FFFFFF;
        }

        .pc-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(42, 50, 76, 0.12);
        }

        .pc-card .pc-img-wrap {
            position: relative;
            height: 160px;
            overflow: hidden;
            background-color: #FFF3D6;
        }

        .pc-card .pc-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .25s ease;
        }

        .pc-card:hover .pc-img-wrap img {
            transform: scale(1.05);
        }

        .pc-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            background-color: #128965;
            color: #fff;
        }

        .pc-badge.status-reserved {
            background-color: #FFD85C;
            color: #2A324C;
        }

        .pc-badge.status-sold {
            background-color: #EC5D5D;
            color: #fff;
        }

        .pc-btn-outline {
            background-color: #fff;
            color: #128965;
            border: 1.5px solid #128965;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 7px 0;
            width: 100%;
            display: block;
            text-align: center;
        }

        .pc-btn-outline:hover {
            background-color: #DCF4EA;
            color: #128965;
        }

        .pc-filter-card {
            border-radius: 14px;
            border: 1px solid #EFE6C0;
        }

        .pc-body {
            padding: 14px 16px 16px;
        }

        .pc-meta {
            font-size: 0.78rem;
            color: #707378;
            margin-bottom: 4px;
        }

        .pc-name {
            font-weight: 700;
            color: #2A324C;
            margin-bottom: 2px;
            font-size: 1rem;
        }

        .pc-price {
            font-weight: 700;
            color: #128965;
            font-size: 1.05rem;
            margin-bottom: 10px;
        }

        .pc-btn {
            background-color: #128965;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 0;
            width: 100%;
            display: block;
            text-align: center;
        }

        .pc-fav-form {
            position: absolute;
            top: 10px;
            right: 10px;
            margin: 0;
        }

        .pc-fav-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.9);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #EC5D5D;
        }

        .pc-btn:hover {
            background-color: #0e6e51;
            color: #fff;
        }
    </style>

    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm py-2">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fs-5" href="{{ route('home') }}">
            <img src="{{ asset('image/logo.png') }}" alt="PawCare" style="width: 30px; height: 30px;" class="me-2">
            PawCare
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto gap-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cats.*') ? 'active' : '' }}" href="{{ route('cats.index') }}">Kucing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favorites.*') ? 'active' : '' }}" href="{{ route('favorites.index') }}">Wishlist</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-3">
                            <a class="nav-link position-relative" href="{{ route('carts.index') }}">
                                <i class="bi bi-cart3" style="font-size: 1.3rem; color: #2A324C;"></i>
                                @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count(); @endphp
                                @if ($cartCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #128965; font-size: 0.65rem;">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex align-items-center justify-content-center me-2"
                                    style="width: 32px; height: 32px; border-radius: 50%; background-color: #FFEBA6; color: #2A324C; font-weight: 700; font-size: 0.9rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span style="color: #2A324C;">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">Pesanan Saya</a>
                                <a class="dropdown-item" href="{{ route('cat_reservations.index') }}">Reservasi Saya</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if (session('success'))
                <div class="container mt-3">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
            @endif

            @if (session('error'))
                <div class="container mt-3">
                    <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="mt-5 py-3" style="background-color: #FFFFFF; border-top: 1px solid #DCD3B2;">
    <div class="container text-center">
        <p class="mb-1 fw-bold small" style="color: #128965;">🐾 PawCare - Cat Care Center</p>
        <p class="small text-muted mb-1">Ada kritik, saran, atau pertanyaan? <i class="bi bi-envelope"></i> pawcare.support@gmail.com</p>
        <p class="small text-muted mb-0">&copy; {{ date('Y') }} PawCare. All rights reserved.</p>
    </div>
</footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>