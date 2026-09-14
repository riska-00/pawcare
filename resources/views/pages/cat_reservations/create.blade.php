@extends('layouts.app')

@section('title', 'Reservasi ' . $cat->name . ' - PawCare')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    :root{ --rc-green:#128965; --rc-green-dark:#0e6e51; --rc-yellow:#FFD85C; --rc-navy:#2A324C; --rc-cream:#FFFAE8; }
    .rc-baloo{ font-family:'Baloo 2',sans-serif; }
    .rc-crumb{font-size:.85rem;color:#707378;margin-bottom:20px;}
    .rc-crumb a{color:#707378;text-decoration:none;}
    .rc-crumb a:hover{color:var(--rc-green);}

    .rc-cat-card{background:#fff;border:1px solid #EFE6C0;border-radius:16px;padding:18px;display:flex;gap:16px;align-items:center;margin-bottom:20px;}
    .rc-cat-photo{width:70px;height:70px;border-radius:12px;overflow:hidden;flex-shrink:0;background:#FFF3D6;}
    .rc-cat-photo img{width:100%;height:100%;object-fit:cover;}
    .rc-cat-name{font-family:'Baloo 2',sans-serif;font-weight:700;font-size:1.1rem;color:var(--rc-navy);}
    .rc-cat-meta{font-size:.85rem;color:#707378;}

    .rc-panel{background:#fff;border:1px solid #EFE6C0;border-radius:20px;padding:28px;}
    .rc-title{font-family:'Baloo 2',sans-serif;font-weight:800;color:var(--rc-navy);font-size:1.4rem;margin-bottom:20px;}

    .rc-btn{background:var(--rc-green);color:#fff;border:none;border-radius:12px;font-weight:700;padding:13px 0;width:100%;font-size:.95rem;}
    .rc-btn:hover{background:var(--rc-green-dark);color:#fff;}

    .rc-note{background:var(--rc-cream);border-radius:16px;padding:20px;}
    .rc-note h6{font-family:'Baloo 2',sans-serif;font-weight:700;color:var(--rc-navy);font-size:.95rem;margin-bottom:12px;}
    .rc-note li{color:#5b5f6b;font-size:.85rem;line-height:1.6;}
</style>
@endsection

@section('content')

<div class="container py-4">

    <div class="rc-crumb">
        <a href="{{ route('cats.index') }}">Kucing</a> &gt;
        <a href="{{ route('cats.show', $cat->id) }}">{{ $cat->name }}</a> &gt;
        <span style="color:#2A324C;">Form Reservasi</span>
    </div>

    <h4 class="rc-baloo fw-bold mb-4" style="color: #2A324C;">Form Reservasi</h4>

    <div class="row g-4">
        <div class="col-md-8">

            <div class="rc-cat-card">
                <div class="rc-cat-photo">
                    @if ($cat->photo)
                        <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}">
                    @endif
                </div>
                <div>
                    <div class="rc-cat-name">{{ $cat->name }}</div>
                    <div class="rc-cat-meta">{{ $cat->breed }} &bull; Rp {{ number_format($cat->price, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="rc-panel">
                <form action="{{ route('cat_reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="cat_id" value="{{ $cat->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #2A324C;">Tanggal Kunjungan</label>
                        <input type="date" name="visit_date" value="{{ old('visit_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="form-control @error('visit_date') is-invalid @enderror">
                        @error('visit_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: #2A324C;">Catatan (Opsional)</label>
                        <textarea name="notes" rows="4"
                            class="form-control @error('notes') is-invalid @enderror"
                            placeholder="Tulis catatan tambahan, misal jam yang diinginkan">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="rc-btn">Kirim Reservasi</button>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="rc-note">
                <h6>📋 Ketentuan Reservasi</h6>
                <ul class="ps-3 mb-0">
                    <li class="mb-2">Reservasi berlaku selama 3 hari kerja sejak tanggal kunjungan.</li>
                    <li class="mb-2">Datang tepat waktu sesuai tanggal yang dipilih.</li>
                    <li class="mb-0">Reservasi dapat dibatalkan oleh admin jika tidak ada konfirmasi.</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection