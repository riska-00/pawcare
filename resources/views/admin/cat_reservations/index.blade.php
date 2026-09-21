@extends('layouts.admin')

@section('title', 'Reservasi Saya - PawCare')

@section('styles')
<style>
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
</style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Reservasi Kucing</h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header py-3" style="background-color: #FFEBA6;">
            <h6 class="m-0 fw-bold" style="color: #2A324C;">Data Reservasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama Kucing</th>
                            <th>Pemesan</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catReservations as $reservation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reservation->kode_reservasi }}</td>
                                <td>{{ $reservation->cat->name ?? '-' }}</td>
                                <td>{{ $reservation->user->name ?? '-' }}</td>
                                <td>{{ $reservation->visit_date->format('d M Y') }}</td>
                                <td>
                                    <span class="rs-status {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.cat_reservations.show', $reservation->id) }}" class="btn btn-link text-secondary p-0" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection