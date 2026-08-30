@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Katalog Kucing - PawCare')

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN ================= --}}
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Katalog Kucing</h3>
            <a href="{{ route('admin.cats.create') }}" class="btn" style="background-color: #128965; color: #fff;">
                + Tambah Kucing
            </a>
        </div>

        <form method="GET" action="{{ route('cats.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama kucing...">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="reserved" {{ request('status') === 'reserved' ? 'selected' : '' }}>Reserved</option>
                    <option value="sold" {{ request('status') === 'sold' ? 'selected' : '' }}>Sold</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn w-100" style="background-color: #FFD85C; color: #2A324C;">Cari</button>
            </div>
        </form>

        <div class="card shadow-sm border-0">
            <div class="card-header py-3" style="background-color: #FFEBA6;">
                <h6 class="m-0 fw-bold" style="color: #2A324C;">Data Kucing</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Ras</th>
                                <th>Usia</th>
                                <th>JK</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cats as $cat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($cat->photo)
                                            <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="width: 50px; height: 50px; border-radius: 8px; font-size: 0.7rem;">
                                                No Photo
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ $cat->breed }}</td>
                                    <td>{{ $cat->age }}</td>
                                    <td>{{ $cat->gender === 'jantan' ? 'Jantan' : 'Betina' }}</td>
                                    <td>Rp {{ number_format($cat->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge" style="background-color:
                                            {{ $cat->status === 'available' ? '#128965' : ($cat->status === 'reserved' ? '#FFD85C' : '#EC5D5D') }};
                                            color: {{ $cat->status === 'reserved' ? '#2A324C' : '#FFFFFF' }};">
                                            {{ ucfirst($cat->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('cats.show', $cat->id) }}" class="btn btn-link text-secondary p-0 mx-2" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.cats.edit', $cat->id) }}" class="btn btn-link p-0 mx-2" title="Edit" style="color: #128965;">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" onclick="handleDestroy('{{ route('admin.cats.destroy', $cat->id) }}')"
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
        $('.datatable').DataTable();

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

        <form method="GET" action="{{ route('cats.index') }}" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}"
                class="form-control form-control-lg" placeholder="Cari kucing...">
        </form>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm p-3">
                    <h6 class="fw-bold mb-3">Filter</h6>

                    <form method="GET" action="{{ route('cats.index') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <div class="mb-3">
                            <label class="form-label small">Ras</label>
                            <select name="breed" class="form-select form-select-sm">
                                <option value="">Semua Ras</option>
                                @foreach ($breeds as $breed)
                                    <option value="{{ $breed }}" {{ request('breed') === $breed ? 'selected' : '' }}>{{ $breed }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Jenis Kelamin</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <option value="jantan" {{ request('gender') === 'jantan' ? 'selected' : '' }}>Jantan</option>
                                <option value="betina" {{ request('gender') === 'betina' ? 'selected' : '' }}>Betina</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Harga Min</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control form-control-sm" placeholder="Rp 0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Harga Max</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control form-control-sm" placeholder="Rp 10.000.000">
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #128965; color: #fff;">Terapkan</button>
                    </form>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row g-3">
                    @forelse ($cats as $cat)
                        <div class="col-md-4 col-6">
                            <div class="card h-100 border-0 shadow-sm">
                                @if ($cat->photo)
                                    <img src="{{ asset('storage/' . $cat->photo) }}" class="card-img-top" alt="{{ $cat->name }}" style="height: 180px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                                        <span class="text-muted small">Tidak ada foto</span>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <span class="badge mb-2" style="background-color: {{ $cat->status === 'available' ? '#128965' : '#EC5D5D' }};">
                                        {{ ucfirst($cat->status) }}
                                    </span>
                                    <h6 class="fw-bold">{{ $cat->name }}</h6>
                                    <p class="small text-muted mb-2">{{ $cat->breed }} &bull; Rp {{ number_format($cat->price, 0, ',', '.') }}</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('cats.show', $cat->id) }}" class="btn btn-sm btn-outline-secondary flex-fill">Detail</a>
                                        @if ($cat->status === 'available')
                                            <a href="{{ route('cat_reservations.create', $cat->id) }}" class="btn btn-sm flex-fill" style="background-color: #128965; color: #fff;">Reservasi</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada kucing yang tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endif

@endsection