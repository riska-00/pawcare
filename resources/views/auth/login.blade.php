@extends('layouts.auth')

@section('title', 'Login - PawCare')

@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="Masukkan email Anda" autofocus>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Masukkan password Anda">

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember"
                class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-pawcare">
                Login
            </button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('password.request') }}">Lupa password?</a>
    </div>

    <div class="text-center mt-2">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
    </div>

@endsection