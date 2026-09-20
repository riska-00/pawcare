@extends('layouts.auth')

@section('title', 'Lupa Password - PawCare')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <p class="text-center text-muted mb-3">Masukkan email Anda, kami akan kirimkan link untuk reset password.</p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-pawcare">
                Kirim Link Reset Password
            </button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>

@endsection