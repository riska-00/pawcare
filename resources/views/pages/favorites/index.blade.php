@extends('layouts.app')

@section('title', 'Wishlist - PawCare')

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-4" style="color: #2A324C;">Wishlist Saya</h3>

    @if ($favorites->isEmpty())

        <div class="text-center py-5">
            <i class="bi bi-heart" style="font-size: 2.5rem; color: #707378;"></i>
            <p class="text-muted mt-3 mb-3">Wishlist kamu masih kosong.</p>
            <div class="d-flex gap-2 justify-content-center">
                <a href="{{ route('cats.index') }}" class="btn" style="background-color: #128965; color: #fff;">
                    Lihat Kucing
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    Lihat Produk
                </a>
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
                        <div class="card h-100 border-0 shadow-sm">
                            @if ($item->photo)
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}"
                                    class="card-img-top" style="height: 160px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 160px;">
                                    <span class="text-muted small">Tidak ada foto</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <span class="badge mb-2" style="background-color: #FFEBA6; color: #2A324C;">
                                    {{ $favorite->favoritable_type === 'cat' ? 'Kucing' : 'Produk' }}
                                </span>
                                <h6 class="fw-bold mb-1">{{ $item->name }}</h6>
                                <p class="small mb-2" style="color: #128965;">Rp {{ number_format($item->price, 0, ',', '.') }}</p>

                                <div class="d-flex gap-2">
                                    <a href="{{ $favorite->favoritable_type === 'cat' ? route('cats.show', $item->id) : route('products.show', $item->id) }}"
                                        class="btn btn-sm btn-outline-secondary flex-fill">Detail</a>

                                    <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST" id="form-delete-fav-{{ $favorite->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="handleDeleteFavorite('{{ $favorite->id }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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