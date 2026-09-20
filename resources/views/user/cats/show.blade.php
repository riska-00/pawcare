@extends('layouts.app')

@section('title', $cat->name . ' - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --cs-green:#128965; --cs-green-dark:#0e6e51; --cs-yellow:#FFD85C; --cs-navy:#2A324C; --cs-coral:#EC5D5D; --cs-cream:#FFFAE8; }
    .cs-baloo{ font-family:'Baloo 2',sans-serif; }
    .cs-back{display:inline-flex;align-items:center;gap:6px;font-size:.88rem;font-weight:600;color:var(--cs-navy);text-decoration:none;margin-bottom:20px;}
    .cs-back:hover{color:var(--cs-green);}

    .cs-photo-wrap{position:relative;border-radius:20px;overflow:hidden;aspect-ratio:4/3;background:#FFF3D6;}
    .cs-photo-wrap img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
    .cs-badge{position:absolute;top:16px;left:16px;font-weight:700;font-size:.8rem;padding:6px 16px;border-radius:20px;}
    .cs-badge.available{background:var(--cs-green);color:#fff;}
    .cs-badge.reserved{background:var(--cs-yellow);color:var(--cs-navy);}
    .cs-badge.sold{background:var(--cs-coral);color:#fff;}
    .cs-fav-btn{position:absolute;top:16px;right:16px;width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.92);border:none;display:flex;align-items:center;justify-content:center;color:var(--cs-coral);font-size:1.1rem;}

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

    .cs-unavailable-note{background:#FFF3D6;border-radius:12px;padding:14px 16px;font-size:.85rem;color:var(--cs-navy);display:flex;align-items:center;gap:10px;}
</style>
@endsection

@section('content')

<div class="container pt-3 pb-5">

    <a href="{{ route('cats.index') }}" class="cs-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Katalog Kucing
    </a>

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

                <button type="button" class="cs-fav-btn" data-id="{{ $cat->id }}" data-type="cat"
                    onclick="toggleFavorite(this)" title="Tambah ke wishlist">
                    <i class="bi {{ $isFavorited ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                </button>
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

                @if ($cat->status === 'available')
                    <a href="{{ route('cat_reservations.create', ['cat_id' => $cat->id]) }}" class="cs-btn">
                        Reservasi Sekarang
                    </a>
                @else
                    <div class="cs-unavailable-note">
                        <i class="bi bi-info-circle"></i>
                        <span>Kucing ini sedang {{ $cat->status === 'reserved' ? 'direservasi' : 'terjual' }}, belum bisa direservasi.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection