@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Profil Saya - PawCare')

@section('content')

<div class="container{{ Auth::user()->role !== 'admin' ? ' py-4' : '-fluid' }}">

    @if (Auth::user()->role === 'admin')
        <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Profil Saya</h3>
        </div>
    @else
        <h3 class="fw-bold mb-4" style="color: #2A324C;">Profil Saya</h3>
    @endif

    <div class="row">
        <div class="col-md-7">

            <div class="card border-0 shadow-sm p-4 mb-3">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Informasi Akun</h6>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="Opsional">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" rows="3"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="Opsional">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Ubah Password</h6>
                    <p class="small text-muted mb-3">Kosongkan bagian ini jika tidak ingin mengubah password.</p>

                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama"
                            class="form-control @error('password_lama') is-invalid @enderror">
                        @error('password_lama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru"
                            class="form-control @error('password_baru') is-invalid @enderror">
                        @error('password_baru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn" style="background-color: #128965; color: #fff;">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

        </div>

        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
                    style="width: 90px; height: 90px; border-radius: 50%; background-color: #FFEBA6; color: #2A324C; font-weight: 700; font-size: 2rem;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h6 class="fw-bold mb-1" style="color: #2A324C;">{{ $user->name }}</h6>
                <p class="small text-muted mb-2">{{ $user->email }}</p>
                <span class="badge mx-auto" style="background-color: {{ $user->role === 'admin' ? '#2A324C' : '#128965' }};">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>
    </div>

</div>

@endsection