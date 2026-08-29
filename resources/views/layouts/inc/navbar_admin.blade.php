<nav class="navbar navbar-light px-4 py-3 d-flex justify-content-between align-items-center" style="background-color: #FFFFFF; border-bottom: 1px solid #DCD3B2;">

    <div class="d-flex align-items-center">
        <img src="{{ asset('image/logo.png') }}" alt="PawCare" style="width: 32px; height: 32px;" class="me-2">
        <div class="fw-bold" style="color: #128965;">PawCare Admin</div>
    </div>

    <div class="d-flex align-items-center">
        <i class="bi bi-bell-fill me-4" style="color: #FFD85C; font-size: 1.2rem;"></i>

        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-center me-2"
                style="width: 36px; height: 36px; border-radius: 50%; background-color: #FFEBA6; color: #2A324C; font-weight: 700;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="small fw-bold" style="color: #2A324C;">{{ Auth::user()->name }}</div>
                <div class="small" style="color: #707378;">Administrator</div>
            </div>
        </div>
    </div>

</nav>