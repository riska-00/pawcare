@extends('layouts.admin')

@section('title', $product->name . ' - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --ps-green:#128965; --ps-green-dark:#0e6e51; --ps-navy:#2A324C; --ps-coral:#EC5D5D; --ps-cream:#FFFAE8; }
    .ps-baloo{ font-family:'Baloo 2',sans-serif; }

    .ps-photo-wrap{position:relative;border-radius:20px;overflow:hidden;aspect-ratio:1/1;background:#FFF3D6;}
    .ps-photo-wrap img{width:100%;height:100%;object-fit:cover;}

    .ps-panel{background:#fff;border-radius:20px;border:1px solid #EFE6C0;padding:32px;height:100%;}
    .ps-cat{font-size:.78rem;color:#707378;text-transform:uppercase;letter-spacing:.03em;margin-bottom:6px;}
    .ps-name{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:1.7rem;color:var(--ps-navy);margin-bottom:6px;}
    .ps-price{color:var(--ps-green);font-weight:800;font-size:1.4rem;margin-bottom:16px;}
    .ps-stock{font-size:.85rem;color:#707378;margin-bottom:20px;}
    .ps-stock strong{color:var(--ps-navy);}

    .ps-desc-title{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--ps-navy);font-size:1rem;margin-bottom:8px;}
    .ps-desc-text{color:#5b5f6b;font-size:.92rem;line-height:1.6;margin-bottom:22px;}

    .ps-btn{background:var(--ps-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:13px 0;width:100%;font-size:.95rem;text-decoration:none;display:block;text-align:center;}
    .ps-btn:hover{background:var(--ps-green-dark);color:#fff;}
    .ps-btn-outline{background:#fff;color:var(--ps-navy);border:2px solid var(--ps-navy);border-radius:12px;font-weight:700;padding:11px 0;width:100%;text-decoration:none;display:block;text-align:center;font-size:.95rem;}
    .ps-btn-outline:hover{background:var(--ps-cream);color:var(--ps-navy);}
</style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Produk</h3>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="ps-photo-wrap">
                @if ($product->photo)
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <span class="text-muted">Tidak ada foto</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="ps-panel">
                <div class="ps-cat">{{ $product->category }}</div>
                <div class="ps-name ps-baloo">{{ $product->name }}</div>
                <div class="ps-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="ps-stock">Stok tersedia: <strong>{{ $product->stock }}</strong></div>

                <div class="ps-desc-title ps-baloo">Deskripsi</div>
                <p class="ps-desc-text">{{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}</p>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="ps-btn">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                    <a href="{{ route('products.index') }}" class="ps-btn-outline">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection