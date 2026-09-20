@extends('layouts.admin')

@section('title', $cat->name . ' - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --cs-green:#128965; --cs-green-dark:#0e6e51; --cs-yellow:#FFD85C; --cs-navy:#2A324C; --cs-coral:#EC5D5D; --cs-cream:#FFFAE8; }
    .cs-baloo{ font-family:'Baloo 2',sans-serif; }

    .cs-photo-wrap{position:relative;border-radius:20px;overflow:hidden;aspect-ratio:4/3;background:#FFF3D6;}
    .cs-photo-wrap img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
    .cs-badge{position:absolute;top:16px;left:16px;font-weight:700;font-size:.8rem;padding:6px 16px;border-radius:20px;}
    .cs-badge.available{background:var(--cs-green);color:#fff;}
    .cs-badge.reserved{background:var(--cs-yellow);color:var(--cs-navy);}
    .cs-badge.sold{background:var(--cs-coral);color:#fff;}

    .cs-panel{background:#fff;border-radius:20px;border:1px solid #EFE6C0;padding:32px;height:100%;}
    .cs-name{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.9rem;color:var(--cs-navy);margin-bottom:4px;}
    .cs-price{color:var(--cs-green);font-weight:800;font-size:1.4rem;margin-bottom:20px;}

    .cs-meta-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:22px;}
    .cs-meta-item{background:var(--cs-cream);border-radius:12px;padding:12px 16px;}
    .cs-meta-label{font-size:.72rem;color:#707378;text-transform:uppercase;letter-spacing:.03em;margin-bottom:2px;}
    .cs-meta-value{font-weight:700;color:var(--cs-navy);font-size:.95rem;}

    .cs-desc-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--cs-navy);font-size:1rem;margin-bottom:8px;}
    .cs-desc-text{color:#5b5f6b;font-size:.92rem;line-height:1.6;margin-bottom:24px;}

    .cs-btn{background:var(--cs-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:13px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.95rem;}
    .cs-btn:hover{background:var(--cs-green-dark);color:#fff;}
    .cs-btn-outline{background:#fff;color:var(--cs-navy);border:2px solid var(--cs-navy);border-radius:12px;font-weight:700;padding:11px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.95rem;}
    .cs-btn-outline:hover{background:var(--cs-cream);color:var(--cs-navy);}
</style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Kucing</h3>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="cs-photo-wrap">
                @if ($cat->photo)
                    <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <span class="text-muted">Tidak ada foto</span>
                    </div>
                @endif

                <span class="cs-badge {{ $cat->status }}">{{ ucfirst($cat->status) }}</span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="cs-panel">
                <div class="cs-name cs-baloo">{{ $cat->name }}</div>
                <div class="cs-price">Rp {{ number_format($cat->price, 0, ',', '.') }}</div>

                <div class="cs-meta-grid">
                    <div class="cs-meta-item">
                        <div class="cs-meta-label">Ras</div>
                        <div class="cs-meta-value">{{ $cat->breed }}</div>
                    </div>
                    <div class="cs-meta-item">
                        <div class="cs-meta-label">Jenis Kelamin</div>
                        <div class="cs-meta-value">{{ $cat->gender === 'jantan' ? 'Jantan' : 'Betina' }}</div>
                    </div>
                    <div class="cs-meta-item">
                        <div class="cs-meta-label">Usia</div>
                        <div class="cs-meta-value">{{ $cat->age }}</div>
                    </div>
                    <div class="cs-meta-item">
                        <div class="cs-meta-label">Status</div>
                        <div class="cs-meta-value">{{ ucfirst($cat->status) }}</div>
                    </div>
                </div>

                <div class="cs-desc-title cs-baloo">Deskripsi</div>
                <p class="cs-desc-text">{{ $cat->description ?: 'Tidak ada deskripsi untuk kucing ini.' }}</p>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.cats.edit', $cat->id) }}" class="cs-btn">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                    <a href="{{ route('cats.index') }}" class="cs-btn-outline">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection