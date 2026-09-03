@extends('layouts.app')

@section('title', 'Reservasi ' . $cat->name . ' - PawCare')

@section('content')

<div class="container py-4">
    <a href="{{ route('cats.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Kucing
    </a>

    <nav class="mb-3">
        <a href="{{ route('cats.index') }}" class="text-decoration-none text-muted small">Kucing</a>
        <span class="text-muted small"> &gt; </span>
        <a href="{{ route('cats.show', $cat->id) }}" class="text-decoration-none text-muted small">{{ $cat->name }}</a>
        <span class="text-muted small"> &gt; </span>
        <span class="small" style="color: #2A324C;">Form Reservasi</span>
    </nav>

    <h4 class="fw-bold mb-4" style="color: #2A324C;">Form Reservasi</h4>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 mb-3">
                <div class="d-flex gap-3 align-items-center">
                    @if ($cat->photo)
                        <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                            style="width: 80px; height: 80px; border-radius: 8px;">No Photo</div>
                    @endif
                    <div>
                        <h6 class="fw-bold mb-1">{{ $cat->name }}</h6>
                        <p class="small text-muted mb-0">{{ $cat->breed }} &bull; Rp {{ number_format($cat->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <form action="{{ route('cat_reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="cat_id" value="{{ $cat->id }}">

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kunjungan</label>
                        <input type="date" name="visit_date" value="{{ old('visit_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="form-control @error('visit_date') is-invalid @enderror">
                        @error('visit_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="notes" rows="4"
                            class="form-control @error('notes') is-invalid @enderror"
                            placeholder="Tulis catatan tambahan, misal jam yang diinginkan">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn w-100" style="background-color: #128965; color: #fff;">
                        Kirim Reservasi
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Ketentuan Reservasi</h6>
                <ul class="small text-muted ps-3">
                    <li class="mb-2">Reservasi berlaku selama 3 hari kerja sejak tanggal kunjungan.</li>
                    <li class="mb-2">Datang tepat waktu sesuai tanggal yang dipilih.</li>
                    <li class="mb-2">Reservasi dapat dibatalkan oleh admin jika tidak ada konfirmasi.</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection