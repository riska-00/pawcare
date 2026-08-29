<div class="admin-sidebar d-flex flex-column p-3" style="width: 260px; min-height: 100vh; background-color: #FFF8DA; border-right: 1px solid #DCD3B2;">

    <div class="text-uppercase small fw-bold px-2 mb-2" style="color: #707378;">Menu</div>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link d-flex align-items-center px-3 py-2"
                style="color: #2A324C; background-color: {{ request()->routeIs('admin.dashboard') ? '#DCF4EA' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('admin.dashboard') ? '#128965' : 'transparent' }}; border-radius: 0;">
                <i class="bi bi-bar-chart me-2" style="color: {{ request()->routeIs('admin.dashboard') ? '#128965' : '#2A324C' }}"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('cats.index') }}"
                class="nav-link d-flex align-items-center px-3 py-2"
                style="color: #2A324C; background-color: {{ request()->routeIs('cats.index') ? '#DCF4EA' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('cats.index') ? '#128965' : 'transparent' }}; border-radius: 0;">
                <i class="fa-solid fa-paw me-2" style="color: {{ request()->routeIs('cats.index') ? '#128965' : '#2A324C' }}"></i> Katalog Kucing
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('products.index') }}"
                class="nav-link d-flex align-items-center px-3 py-2"
                style="color: #2A324C; background-color: {{ request()->routeIs('products.index') ? '#DCF4EA' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('products.index') ? '#128965' : 'transparent' }}; border-radius: 0;">
                <i class="bi bi-box-seam me-2" style="color: {{ request()->routeIs('products.index') ? '#128965' : '#2A324C' }}"></i> Katalog Produk
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('admin.cat_reservations.index') }}"
                class="nav-link d-flex align-items-center px-3 py-2"
                style="color: #2A324C; background-color: {{ request()->routeIs('admin.cat_reservations.index') ? '#DCF4EA' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('admin.cat_reservations.index') ? '#128965' : 'transparent' }}; border-radius: 0;">
                <i class="bi bi-calendar-check me-2" style="color: {{ request()->routeIs('admin.cat_reservations.index') ? '#128965' : '#2A324C' }}"></i> Reservasi Kucing
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('admin.payments.index') }}"
               class="nav-link d-flex align-items-center px-3 py-2"
               style="color: #2A324C; background-color: {{ request()->routeIs('admin.payments.index') ? '#DCF4EA' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('admin.payments.index') ? '#128965' : 'transparent' }}; border-radius: 0;">
                <i class="bi bi-truck me-2" style="color: {{ request()->routeIs('admin.payments.index') ? '#128965' : '#2A324C' }}"></i> Pembayaran &amp; Pengiriman
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="#" class="nav-link d-flex align-items-center px-3 py-2" style="color: #2A324C;">
                <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('profile.edit') }}"
               class="nav-link d-flex align-items-center px-3 py-2"
               style="color: #2A324C; background-color: {{ request()->routeIs('profile.edit') ? '#DCF4EA' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('profile.edit') ? '#128965' : 'transparent' }}; border-radius: 0;">
                <i class="bi bi-person me-2" style="color: {{ request()->routeIs('profile.edit') ? '#128965' : '#2A324C' }}"></i> Profil
            </a>
        </li>
    </ul>

    <hr style="border-color: #DCD3B2;">

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="nav-link d-flex align-items-center border-0 bg-transparent w-100" style="color: #EC5D5D;">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>

</div>