@extends('layouts.auth')

@section('title', 'Konfirmasi Password - PawCare')

@section('content')

    <p class="text-center text-muted mb-3">Mohon konfirmasi password Anda sebelum melanjutkan.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-pawcare">
                Konfirmasi Password
            </button>
        </div>

        @if (Route::has('password.request'))
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>
        @endif
    </form>

@endsection