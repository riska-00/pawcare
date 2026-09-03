@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Katalog Kucing - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root{
        --cc-green:#128965;
        --cc-green-dark:#0e6e51;
        --cc-yellow:#FFD85C;
        --cc-navy:#2A324C;
        --cc-coral:#EC5D5D;
        --cc-cream:#FFFAE8;
    }
    .cc-font{ font-family:'Baloo 2',sans-serif; }
    .cc-label-tag{display:inline-block;padding:4px 14px;border-radius:20px;background:#fff;border:2px solid var(--cc-navy);font-weight:700;font-size:.72rem;margin:8px 0;color:var(--cc-navy);}
        .cc-hero{ position:relative; padding:60px 0 70px; overflow:hidden; font-family:'Baloo 2',sans-serif;
        background: radial-gradient(circle at 12% 18%, rgba(18,137,101,.16) 0%, transparent 35%),
                    radial-gradient(circle at 88% 12%, rgba(255,216,92,.35) 0%, transparent 32%),
                    radial-gradient(circle at 90% 85%, rgba(236,93,93,.14) 0%, transparent 30%),
                    var(--cc-cream);
    }

    .cc-hero::after{
        content:"";
        position:absolute;
        left:0; right:0; bottom:0;
        height:80px;
        background:linear-gradient(to bottom, transparent, var(--cc-cream));
        pointer-events:none;
    }
    .cc-blob{position:absolute;border-radius:50%;opacity:.55;}
    .cc-b1{width:150px;height:150px;background:var(--cc-yellow);top:10px;left:6%;}
    .cc-b2{width:100px;height:100px;background:var(--cc-green);opacity:.18;bottom:10px;right:10%;}
    .cc-hero h1{font-size:2.6rem;font-weight:800;color:var(--cc-navy);}
    .cc-hero h1 span{color:var(--cc-green);}
    .cc-hero p{color:#5b5f6b;font-size:1.05rem;max-width:480px;margin:0 auto 26px;font-family:-apple-system,sans-serif;}
    .cc-search-pill{max-width:520px;margin:0 auto;background:#fff;border-radius:60px;padding:8px;display:flex;box-shadow:0 10px 30px rgba(42,50,76,.12);border:1px solid #EFE6C0;}
    .cc-search-pill input{border:none;flex:1;padding:10px 18px;font-family:-apple-system,sans-serif;font-size:1rem;background:transparent;}
    .cc-search-pill input:focus{outline:none;}
    .cc-search-pill button{border:none;background:var(--cc-green);color:#fff;border-radius:50px;padding:0 26px;font-weight:700;}
    .cc-search-pill button:hover{background:var(--cc-green-dark);}
    .cc-chips{display:flex;justify-content:center;gap:10px;margin-top:24px;flex-wrap:wrap;}
    .cc-chip{background:#fff;border:2px solid var(--cc-navy);border-radius:20px;padding:6px 16px;font-weight:700;font-size:.85rem;color:var(--cc-navy);text-decoration:none;}
    .cc-chip.on{background:var(--cc-green);color:#fff;border-color:var(--cc-green);}

    .cc-filter-bar{background:#fff;border:1px solid #EFE6C0;border-radius:20px;padding:14px 18px;margin:28px 0 24px;display:flex;flex-wrap:wrap;gap:12px;align-items:center;font-family:-apple-system,sans-serif;}
    .cc-filter-bar select, .cc-filter-bar input{border:1.5px solid #EFE6C0;border-radius:14px;padding:6px 14px;font-size:.85rem;color:var(--cc-navy);}
    .cc-filter-bar button{border:2px solid var(--cc-navy);background:var(--cc-yellow);color:var(--cc-navy);border-radius:14px;padding:6px 18px;font-weight:700;font-size:.85rem;}

    .cc-card{background:#fff;border-radius:28px;border:3px solid var(--cc-navy);overflow:hidden;transition:transform .15s;font-family:-apple-system,sans-serif;}
    .cc-card:hover{transform:rotate(-1deg) translateY(-4px);}
    .cc-imgwrap{position:relative;height:190px;background:var(--cc-yellow);}
    .cc-imgwrap img{width:100%;height:100%;object-fit:cover;}
    .cc-badge{position:absolute;top:10px;left:10px;background:var(--cc-green);color:#fff;font-weight:800;padding:4px 12px;border-radius:20px;font-size:.75rem;border:2px solid var(--cc-navy);}
    .cc-badge.status-reserved{background:var(--cc-yellow);color:var(--cc-navy);}
    .cc-badge.status-sold{background:var(--cc-coral);color:#fff;}
    .cc-fav-form{position:absolute;top:10px;right:10px;margin:0;}
    .cc-fav-btn{width:34px;height:34px;background:#fff;border:2px solid var(--cc-navy);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--cc-coral);}
    .cc-body{padding:16px;}
    .cc-meta{font-size:.78rem;color:#707378;margin-bottom:4px;}
    .cc-name{font-weight:800;font-size:1.2rem;color:var(--cc-navy);}
    .cc-price{color:var(--cc-green);font-weight:700;margin-bottom:12px;}
    .cc-btn{width:100%;background:var(--cc-green);border:2px solid var(--cc-navy);border-radius:20px;color:#fff;font-weight:800;padding:8px 0;text-decoration:none;display:block;text-align:center;font-size:.85rem;}
    .cc-btn:hover{background:var(--cc-green-dark);color:#fff;}
    .cc-btn.cc-outline{background:#fff;color:var(--cc-navy);}
    .cc-btn.cc-outline:hover{background:var(--cc-cream);color:var(--cc-navy);}
</style>
@endsection

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN  ================= --}}
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
                    <table class="table table-bordered table-hover">
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

    @php
        $statusOptions = ['available' => 'Available', 'reserved' => 'Reserved', 'sold' => 'Sold'];
    @endphp

    <div class="cc-hero text-center">
        <div class="cc-blob cc-b1"></div><div class="cc-blob cc-b2"></div>
        <div class="container position-relative">
            <span class="cc-label-tag">🐾 Katalog Kucing</span>
            <h1>Cari Teman <span>Purr-fect</span><br>Kamu di Sini!</h1>
            <p>Yuk temukan kucing lucu yang siap jadi bagian dari keluargamu, penuh kasih dan siap main kapan aja!</p>

            <form method="GET" action="{{ route('cats.index') }}">
                @foreach (request()->except(['search', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <div class="cc-search-pill">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kucing lucu...">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="cc-chips">
                <a href="{{ route('cats.index', array_merge(request()->except(['status', 'page']), ['status' => ''])) }}"
                   class="cc-chip {{ request('status') ? '' : 'on' }}">Semua</a>
                @foreach ($statusOptions as $value => $label)
                    <a href="{{ route('cats.index', array_merge(request()->except(['status', 'page']), ['status' => $value])) }}"
                       class="cc-chip {{ request('status') === $value ? 'on' : '' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container pb-5">

        <div class="cc-filter-bar">
            <form method="GET" action="{{ route('cats.index') }}" class="d-flex flex-wrap gap-2 align-items-center w-100">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="status" value="{{ request('status') }}">

                <select name="breed">
                    <option value="">Semua Ras</option>
                    @foreach ($breeds as $breed)
                        <option value="{{ $breed }}" {{ request('breed') === $breed ? 'selected' : '' }}>{{ $breed }}</option>
                    @endforeach
                </select>

                <select name="gender">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="jantan" {{ request('gender') === 'jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="betina" {{ request('gender') === 'betina' ? 'selected' : '' }}>Betina</option>
                </select>

                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Harga Min">
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Harga Max">

                <button type="submit" class="ms-auto">Terapkan</button>
            </form>
        </div>

         <div class="row g-3">
            @forelse ($cats as $cat)
                <div class="col-md-3 col-6">
                    <div class="pc-card h-100">
                        <div class="pc-img-wrap" style="height: 180px;">
                            @if ($cat->photo)
                                <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <span class="text-muted small">Tidak ada foto</span>
                                </div>
                            @endif
                            <span class="pc-badge status-{{ $cat->status }}">{{ ucfirst($cat->status) }}</span>
                            <form action="{{ route('favorites.store') }}" method="POST" class="pc-fav-form">
                                @csrf
                                <input type="hidden" name="favoritable_id" value="{{ $cat->id }}">
                                <input type="hidden" name="favoritable_type" value="cat">
                                <button type="submit" class="pc-fav-btn" title="Tambah ke wishlist">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </form>
                        </div>
                        <div class="pc-body">
                            <p class="pc-meta mb-1">{{ $cat->breed }} &bull; {{ $cat->gender === 'jantan' ? 'Jantan' : 'Betina' }}</p>
                            <div class="pc-name">{{ $cat->name }}</div>
                            <div class="pc-price">Rp {{ number_format($cat->price, 0, ',', '.') }}</div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('cats.show', $cat->id) }}" class="{{ $cat->status === 'available' ? 'pc-btn-outline' : 'pc-btn' }} flex-fill">Detail</a>
                                @if ($cat->status === 'available')
                                    <a href="{{ route('cat_reservations.create', ['cat_id' => $cat->id]) }}" class="pc-btn flex-fill">Reservasi</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada kucing yang tersedia.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $cats->links() }}
        </div>
    </div>

@endif
@endsection