<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'PawCare Admin')</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <style>
        body {
            background-color: #FFFAE8;
        }
 
        .nav-link:hover {
            background-color: #DCF4EA !important;
        }

        .pagination {
            --bs-pagination-color: #128965;
            --bs-pagination-bg: #FFFFFF;
            --bs-pagination-border-color: #EFE6C0;
            --bs-pagination-border-radius: 10px;
            --bs-pagination-hover-color: #0e6e51;p
            --bs-pagination-hover-bg: #DCF4EA;
            --bs-pagination-hover-border-color: #EFE6C0;
            --bs-pagination-focus-color: #0e6e51;
            --bs-pagination-focus-bg: #DCF4EA;
            --bs-pagination-active-color: #FFFFFF;
            --bs-pagination-active-bg: #128965;
            --bs-pagination-active-border-color: #128965;
            --bs-pagination-disabled-color: #707378;
            --bs-pagination-disabled-bg: #FFFAE8;
            --bs-pagination-disabled-border-color: #EFE6C0;
        }
    </style>
 
    @yield('styles')
</head>
<body>

    @include('layouts.inc.navbar_admin')

    <div class="d-flex">
    @include('layouts.inc.sidebar')

    <div class="flex-fill d-flex flex-column">
        <main class="p-4 flex-fill">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
                
            @endif

            @if (session('error'))
            <div class="alert alert-danger">{{ session('error')}}</div>
                
            @endif

            @yield('content')
        </main>

        @include('layouts.inc.footer')
    </div>
</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('vendor/chartjs/chart.umd.js') }}"></script>

@if (session('success'))
    <script>
        Swal.fire({ icon: 'success', title: 'Berhasil', text: '{{ session('success') }}' });
    </script>
@endif

@stack('scripts')
    
</body>
</html>