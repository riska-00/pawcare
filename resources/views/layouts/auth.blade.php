<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'PawCare'))</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #FFFAE8;
            height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .auth-card {
            border: 1px solid #DCD3B2;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .auth-logo {
            font-size: 48px;
        }

        .auth-title {
            color: #2A324C;
            font-weight: 700;
        }

        .auth-subtitle {
            color: #707378;
        }

        .form-label {
            color: #2A324C;
            font-weight: 600;
        }

        .auth-card .form-control {
            background-color: #FFEBA6;
            border: 1px solid #DCD3B2;
            border-radius: 10px;
        }

        .auth-card .form-control:focus {
            background-color: #FFEBA6;
            border-color: #128965;
            box-shadow: 0 0 0 0.2rem rgba(18, 137, 101, 0.15);
        }

        .auth-card .form-control::placeholder {
            color: #707378;
        }

        .btn-pawcare {
            background-color: #128965;
            border-color: #128965;
            color: #FFFFFF;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
        }

        .btn-pawcare:hover {
            background-color: #0e6e51;
            border-color: #0e6e51;
            color: #FFFFFF;
        }

        .auth-card a {
            color: #128965;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-card a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            color: #EC5D5D;
        }

        .is-invalid {
            border-color: #EC5D5D !important;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card auth-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="{{ asset('image/logo.png') }}" alt="PawCare" style="width: 60px; height: 60px;">
                            <h2 class="auth-title mb-0">PawCare</h2>
                            <p class="auth-subtitle small mb-0">Cat Care Center</p>
                        </div>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>