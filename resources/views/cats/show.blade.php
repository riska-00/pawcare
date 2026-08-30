@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', $cat->name . ' - PawCare')

@section('content')

<div class="container-fluid @if(Auth::user()->role !== 'admin') py-4 @endif">

    @if (Auth::user()->role === 'admin')
        <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Kucing</h3>
        </div>
    @else
        <nav class="mb-3">
            <a href="{{ route('cats.index') }}" class="text-decoration-none text-muted small">Kucing</a>
            <span class="text-muted small"> &gt; </span>
            <span class="small" style="color: #2A324C;">{{ $cat->name }}</span>
        </nav>
    @endif

    <div class="row">
        <div class="col-md-5 mb-4">
            @if ($cat->photo)
                <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}"
                    class="img-fluid rounded shadow-sm" style="width: 100%; height: 350px; object-fit: cover;">
            @else
                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 350px;">
                    <span class="text-muted">Tidak ada foto</span>
                </div>
            @endif
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h3 class="fw-bold mb-0" style="color: #2A324C;">{{ $cat->name }}</h3>
                    <span class="badge" style="background-color:
                        {{ $cat->status === 'available' ? '#128965' : ($cat->status === 'reserved' ? '#FFD85C' : '#EC5D5D') }};
                        color: {{ $cat->status === 'reserved' ? '#2A324C' : '#FFFFFF' }};">
                        {{ ucfirst($cat->status) }}
                    </span>
                </div>

                <h5 class="mb-3" style="color: #128965;">Rp {{ number_format($cat->price, 0, ',', '.') }}</h5>

                <hr>

                <table class="table table-borderless mb-3">
                    <tr>
                        <th width="30%" class="ps-0">Ras</th>
                        <td>{{ $cat->breed }}</td>
                    </tr>
                    <tr>
                        <th class="ps-0">Jenis Kelamin</th>
                        <td>{{ $cat->gender === 'jantan' ? 'Jantan' : 'Betina' }}</td>
                    </tr>
                    <tr>
                        <th class="ps-0">Usia</th>
                        <td>{{ $cat->age }}</td>
                    </tr>
                </table>

                <h6 class="fw-bold">Deskripsi</h6>
                <p class="text-muted">{{ $cat->description ?: 'Tidak ada deskripsi.' }}</p>

                <hr>

                <div class="d-flex gap-2">
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.cats.edit', $cat->id) }}" class="btn" style="background-color: #128965; color: #fff;">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('cats.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    @else
                        @if ($cat->status === 'available')
                            <a href="{{ route('cat_reservations.create', $cat->id) }}" class="btn flex-fill" style="background-color: #128965; color: #fff;">
                                Reservasi
                            </a>
                        @endif
                        <form action="{{ route('favorites.store') }}" method="POST" class="flex-fill">
                            @csrf
                            <input type="hidden" name="favoritable_id" value="{{ $cat->id }}">
                            <input type="hidden" name="favoritable_type" value="cat">
                            <button type="submit" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-heart"></i> Tambah ke Wishlist
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>

@endsection