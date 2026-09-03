@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Katalog Produk - PawCare')

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN ================= --}}
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Katalog Produk</h3>
            <a href="{{ route('admin.products.create') }}" class="btn" style="background-color: #128965; color: #fff;">
                + Tambah Produk
            </a>
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama produk...">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn w-100" style="background-color: #FFD85C; color: #2A324C;">Cari</button>
            </div>
        </form>

        <div class="card shadow-sm border-0">
            <div class="card-header py-3" style="background-color: #FFEBA6;">
                <h6 class="m-0 fw-bold" style="color: #2A324C;">Data Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($product->photo)
                                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="width: 50px; height: 50px; border-radius: 8px; font-size: 0.7rem;">
                                                No Photo
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-link text-secondary p-0 mx-2" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-link p-0 mx-2" title="Edit" style="color: #128965;">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" onclick="handleDestroy('{{ route('admin.products.destroy', $product->id) }}')"
                                            class="btn btn-link text-danger p-0 mx-2" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <form id="form-destroy" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

    @push('scripts')
    <script>
        function handleDestroy(url) {
            Swal.fire({
                title: "Yakin hapus data ini?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-destroy').attr('action', url);
                    $('#form-destroy').submit();
                }
            });
        }
    </script>
    @endpush

@else

    {{-- ================= TAMPILAN USER ================= --}}
    <div class="container py-4">

        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}"
                class="form-control form-control-lg" placeholder="Cari produk...">
        </form>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm p-3">
                    <h6 class="fw-bold mb-3">Filter</h6>

                    <form method="GET" action="{{ route('products.index') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <div class="mb-3">
                            <label class="form-label small">Kategori</label>
                            <select name="category" class="form-select form-select-sm">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Harga Min</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control form-control-sm" placeholder="Rp 0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Harga Max</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control form-control-sm" placeholder="Rp 500.000">
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #128965; color: #fff;">Terapkan</button>
                    </form>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row g-3">
                    @forelse ($products as $product)
                        <div class="col-md-4 col-6">
                            <div class="card h-100 border-0 shadow-sm">
                                @if ($product->photo)
                                    <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                                        <span class="text-muted small">Tidak ada foto</span>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $product->name }}</h6>
                                    <p class="small text-muted mb-2">{{ $product->category }} &bull; Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-secondary flex-fill">Detail</a>
                                        @if ($product->stock > 0)
                                            <form action="{{ route('carts.store') }}" method="POST" class="flex-fill">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-sm w-100" style="background-color: #128965; color: #fff;">+Keranjang</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada produk yang tersedia.</p>
                    @endforelse
                </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
        </div>
    </div>

@endif

@endsection