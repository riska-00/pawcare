@extends('layouts.app')

@section('title', 'Reservasi Saya - PawCare')

@section('styles')
<style>
    .rs-card {
        background: #fff;
        border: 1px solid #EFE6C0;
        border-radius: 16px;
        overflow: hidden;
        transition: box-shadow .15s ease, transform .15s ease;
    }

    .rs-card:hover {
        box-shadow: 0 10px 24px rgba(42, 50, 76, 0.08);
    }

    .rs-photo {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .rs-photo-placeholder {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        background: #FFF3D6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #707378;
        font-size: .7rem;
        flex-shrink: 0;
    }

    .rs-status {
        font-size: .72rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .rs-status.pending { background: #FFEBA6; color: #2A324C; }
    .rs-status.confirmed { background: #DCF4EA; color: #128965; }
    .rs-status.paid { background: #128965; color: #fff; }
    .rs-status.completed { background: #2A324C; color: #fff; }
    .rs-status.cancelled { background: #FCE2E2; color: #EC5D5D; }
    .rs-status.expired { background: #EFEFEF; color: #707378; }

    .rs-code {
        font-size: .75rem;
        color: #707378;
    }

    .rs-cat-name {
        font-weight: 700;
        color: #2A324C;
        font-size: 1.05rem;
    }

    .rs-meta {
        font-size: .82rem;
        color: #707378;
    }

    .rs-empty {
        text-align: center;
        padding: 60px 20px;
        color: #707378;
    }
</style>
@endsection

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-4" style="color: #2A324C;">Reservasi Saya</h3>

    @forelse ($catReservations as $reservation)
        <div class="rs-card p-3 mb-3">
            <div class="d-flex gap-3 align-items-center">

                @if ($reservation->cat && $reservation->cat->photo)
                    <img src="{{ asset('storage/' . $reservation->cat->photo) }}" alt="{{ $reservation->cat->name }}" class="rs-photo">
                @else
                    <div class="rs-photo-placeholder">No Photo</div>
                @endif

                <div class="flex-fill">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div>
                            <div class="rs-code mb-1">{{ $reservation->kode_reservasi }}</div>
                            <div class="rs-cat-name">{{ $reservation->cat->name ?? 'Kucing tidak ditemukan' }}</div>
                        </div>
                        <span class="rs-status {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span>
                    </div>

                    <p class="rs-meta mt-2 mb-3">
                        <i class="bi bi-calendar3 me-1"></i>
                        Kunjungan: {{ $reservation->visit_date->format('d M Y') }}
                    </p>

                    <a href="{{ route('cat_reservations.show', $reservation->id) }}" class="pc-btn-outline" style="display:inline-block; width:auto; padding:6px 20px;">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="rs-empty">
            <i class="bi bi-calendar-x" style="font-size: 2.5rem;"></i>
            <p class="mt-3 mb-3">Kamu belum punya reservasi kucing.</p>
            <a href="{{ route('cats.index') }}" class="pc-btn" style="display:inline-block; width:auto; padding:10px 28px;">
                Lihat Katalog Kucing
            </a>
        </div>
    @endforelse

</div>

@endsection