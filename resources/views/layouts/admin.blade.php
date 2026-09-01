<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'PawCare Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.8/css/dataTables.bootstrap5.min.css">
 
    <style>
        body {
            background-color: #FFFAE8;
        }
 
        .nav-link:hover {
            background-color: #DCF4EA !important;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({ icon: 'success', title: 'Berhasil', text: '{{ session('success') }}' });
    </script>
@endif

@stack('scripts')
    
</body>
</html>