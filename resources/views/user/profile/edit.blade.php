@extends('layouts.app')

@section('title', 'Profil Saya - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --pf-green:#128965; --pf-green-dark:#0e6e51; --pf-navy:#2A324C; --pf-cream:#FFFAE8; }
    .pf-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--pf-navy);font-size:1.6rem;}
    .pf-panel{background:#fff;border-radius:20px;border:1px solid #EFE6C0;padding:28px;}
    .pf-panel h6{font-family:'Baloo 2',sans-serif;font-weight:700;}
    .pf-panel label{font-weight:600;color:var(--pf-navy);font-size:.88rem;margin-bottom:6px;}
    .pf-panel .form-control{border-radius:12px;border:1.5px solid #EFE6C0;background:var(--pf-cream);padding:10px 14px;}
    .pf-panel .form-control:focus{border-color:var(--pf-green);background:#fff;box-shadow:0 0 0 .2rem rgba(18,137,101,.12);}
    .pf-panel .btn{background:var(--pf-green);color:#fff;border-radius:10px;font-weight:700;padding:10px 24px;}
    .pf-panel .btn:hover{background:var(--pf-green-dark);color:#fff;}

    .pf-side{background:#fff;border-radius:20px;border:1px solid #EFE6C0;padding:24px 28px;display:flex;align-items:center;gap:20px;margin-bottom:20px;flex-wrap:wrap;}
    .pf-avatar{width:70px;height:70px;border-radius:50%;background:var(--pf-cream);color:var(--pf-navy);font-weight:800;font-size:1.6rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .pf-side h6{font-family:'Baloo 2',sans-serif;font-weight:700;margin-bottom:2px;}
    .pf-role-badge{font-weight:700;font-size:.72rem;padding:4px 14px;border-radius:20px;margin-left:auto;}
    .pf-role-badge.user{background:var(--pf-green);color:#fff;}

    .pf-tabs{display:flex;gap:8px;margin-bottom:20px;border-bottom:1px solid #EFE6C0;}
    .pf-tab-btn{background:none;border:none;padding:10px 4px;font-weight:700;font-size:.9rem;color:#707378;border-bottom:2px solid transparent;margin-bottom:-1px;}
    .pf-tab-btn.active{color:var(--pf-green);border-bottom-color:var(--pf-green);}
</style>
@endsection

@section('content')

<div class="container py-4">

    <h3 class="pf-title mb-4">Profil Saya</h3>

    <div class="pf-side">
        <div class="pf-avatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <h6 class="mb-0" style="color: #2A324C;">{{ $user->name }}</h6>
            <p class="small text-muted mb-0">{{ $user->email }}</p>
        </div>
        <span class="pf-role-badge user">
            {{ ucfirst($user->role) }}
        </span>
    </div>

    <div class="pf-panel mb-3">
        <h6 class="fw-bold mb-3" style="color: #2A324C;">Informasi Akun</h6>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="pf-tabs">
                <button type="button" class="pf-tab-btn active" data-tab="info" onclick="pfSwitchTab('info')">Info Akun</button>
                <button type="button" class="pf-tab-btn {{ $errors->has('password_lama') || $errors->has('password_baru') ? 'active' : '' }}" data-tab="password" onclick="pfSwitchTab('password')">Ubah Password</button>
            </div>

            <div id="pf-tab-info" style="display: {{ $errors->has('password_lama') || $errors->has('password_baru') ? 'none' : 'block' }};">
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

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" rows="3"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Opsional">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div id="pf-tab-password" style="display: {{ $errors->has('password_lama') || $errors->has('password_baru') ? 'block' : 'none' }};">
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
            </div>

            <button type="submit" class="btn" style="background-color: #128965; color: #fff;">
                Simpan Perubahan
            </button>
        </form>

        <script>
            function pfSwitchTab(tab) {
                document.getElementById('pf-tab-info').style.display = tab === 'info' ? 'block' : 'none';
                document.getElementById('pf-tab-password').style.display = tab === 'password' ? 'block' : 'none';
                document.querySelectorAll('.pf-tab-btn').forEach(btn => btn.classList.toggle('active', btn.dataset.tab === tab));
            }
        </script>
    </div>

</div>

@endsection