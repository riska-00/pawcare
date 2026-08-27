@extends('layouts.auth')

@section('title', 'Daftar - PawCare')

@section('content')

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" autofocus>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}">

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password">

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Konfirmasi Password</label>
            <input id="password-confirm" type="password" class="form-control"
                name="password_confirmation">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-pawcare">
                Daftar
            </button>
        </div>
    </form>

    <div class="text-center mt-3">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>

@endsection