@extends('layouts.app')

@section('title', 'Wishlist - PawCare')

@section('styles')
<style>
    :root{ --wl-green:#128965; --wl-green-dark:#0e6e51; --wl-yellow:#FFD85C; --wl-navy:#2A324C; --wl-coral:#EC5D5D; --wl-cream:#FFFAE8; }
    .wl-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--wl-navy);font-size:1.6rem;margin-bottom:20px;}

    .wl-tile{position:relative;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #EFE6C0;text-decoration:none;display:block;transition:box-shadow .15s ease, transform .15s ease;}
    .wl-tile:hover{box-shadow:0 10px 24px rgba(42,50,76,.1);transform:translateY(-3px);}
    .wl-img-wrap{position:relative;aspect-ratio:1/1;background:#FFF3D6;}
    .wl-img-wrap img{width:100%;height:100%;object-fit:cover;}
    .wl-type-badge{position:absolute;top:10px;left:10px;font-size:.68rem;font-weight:700;padding:4px 10px;border-radius:20px;color:#fff;}
    .wl-type-badge.cat{background:var(--wl-green);}
    .wl-type-badge.product{background:var(--wl-yellow);color:var(--wl-navy);}
    .wl-remove-btn{position:absolute;top:10px;right:10px;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.92);border:none;display:flex;align-items:center;justify-content:center;color:var(--wl-coral);font-size:1rem;z-index:2;}
    .wl-body{padding:12px 14px;}
    .wl-name{font-weight:700;color:var(--wl-navy);font-size:.92rem;margin-bottom:2px;}
    .wl-price{font-weight:700;color:var(--wl-green);font-size:.88rem;}

    .wl-empty{text-align:center;padding:60px 20px;color:#707378;}
    .wl-empty i{font-size:2.6rem;color:#DCD3B2;margin-bottom:12px;display:block;}
    .wl-empty .btns a{border-radius:30px;padding:10px 24px;font-weight:700;font-size:.9rem;text-decoration:none;display:inline-block;}
    .wl-empty .btn-primary-wl{background:var(--wl-green);color:#fff;}
    .wl-empty .btn-primary-wl:hover{background:var(--wl-green-dark);color:#fff;}
    .wl-empty .btn-outline-wl{border:2px solid var(--wl-navy);color:var(--wl-navy);background:#fff;}
</style>
@endsection

@section('content')

<div class="container py-4">

    <h3 class="wl-title">Wishlist Saya</h3>

    @if ($favorites->isEmpty())

        <div class="wl-empty">
            <i class="bi bi-heart"></i>
            <p class="mb-3">Wishlist kamu masih kosong.</p>
            <div class="btns d-flex gap-2 justify-content-center">
                <a href="{{ route('cats.index') }}" class="btn-primary-wl">Lihat Kucing</a>
                <a href="{{ route('products.index') }}" class="btn-outline-wl">Lihat Produk</a>
            </div>
        </div>

    @else

        <div class="row g-3">
            @foreach ($favorites as $favorite)
                @php
                    $item = $favorite->favoritable;
                @endphp

                @if ($item)
                    <div class="col-md-3 col-6">
                        <a href="{{ $favorite->favoritable_type === 'cat' ? route('cats.show', $item->id) : route('products.show', $item->id) }}" class="wl-tile">
                            <div class="wl-img-wrap">
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <span class="text-muted small">Tidak ada foto</span>
                                    </div>
                                @endif
                                <span class="wl-type-badge {{ $favorite->favoritable_type }}">
                                    {{ $favorite->favoritable_type === 'cat' ? 'Kucing' : 'Produk' }}
                                </span>
                                <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST" id="form-delete-fav-{{ $favorite->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="wl-remove-btn" onclick="event.preventDefault(); handleDeleteFavorite('{{ $favorite->id }}')" title="Hapus dari wishlist">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="wl-body">
                                <div class="wl-name">{{ $item->name }}</div>
                                <div class="wl-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

    @endif

</div>

<script>
    function handleDeleteFavorite(id) {
        Swal.fire({
            title: "Hapus dari wishlist?",
            text: "Item akan dihapus dari wishlist kamu.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-fav-' + id).submit();
            }
        });
    }
</script>

@endsection