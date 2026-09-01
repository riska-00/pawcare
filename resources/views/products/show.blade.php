@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', $product->name . ' - PawCare')

@section('content')

<div class="container-fluid @if(Auth::user()->role !== 'admin') py-4 @endif">

    @if (Auth::user()->role === 'admin')
        <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Produk</h3>
        </div>
    @else
        <nav class="mb-3">
            <a href="{{ route('products.index') }}" class="text-decoration-none text-muted small">Produk</a>
            <span class="text-muted small"> &gt; </span>
            <span class="small" style="color: #2A324C;">{{ $product->name }}</span>
        </nav>
    @endif

    <div class="row">
        <div class="col-md-5 mb-4">
            @if ($product->photo)
                <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                    class="img-fluid rounded shadow-sm" style="width: 100%; height: 350px; object-fit: cover;">
            @else
                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 350px;">
                    <span class="text-muted">Tidak ada foto</span>
                </div>
            @endif
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4">

                <h3 class="fw-bold mb-1" style="color: #2A324C;">{{ $product->name }}</h3>
                <p class="text-muted mb-2">{{ $product->category }}</p>

                <h5 class="mb-3" style="color: #128965;">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>

                <hr>

                <table class="table table-borderless mb-3">
                    <tr>
                        <th width="30%" class="ps-0">Kategori</th>
                        <td>{{ $product->category }}</td>
                    </tr>
                    <tr>
                        <th class="ps-0">Stok</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                </table>

                <h6 class="fw-bold">Deskripsi</h6>
                <p class="text-muted">{{ $product->description ?: 'Tidak ada deskripsi.' }}</p>

                <hr>

                @if (Auth::user()->role === 'admin')
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn" style="background-color: #128965; color: #fff;">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                @else
                    <form action="{{ route('carts.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <label class="mb-0">Jumlah</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                class="form-control" style="width: 80px;">
                        </div>

                        <div class="d-flex gap-2">
                            @if ($product->stock > 0)
                                <button type="submit" class="btn flex-fill" style="background-color: #128965; color: #fff;">
                                    Tambah Ke Keranjang
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary flex-fill" disabled>Stok Habis</button>
                            @endif
                        </div>
                    </form>

                    <form action="{{ route('favorites.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="favoritable_id" value="{{ $product->id }}">
                        <input type="hidden" name="favoritable_type" value="product">
                        <button type="submit" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-heart"></i> Tambah ke Wishlist
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>

</div>

@endsection