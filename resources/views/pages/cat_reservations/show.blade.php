@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Detail Reservasi - PawCare')

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN ================= --}}
    <div class="container-fluid">

        <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Reservasi</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm p-4 mb-3">
                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Informasi Reservasi</h6>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="35%">Kode Reservasi</th>
                            <td>{{ $catReservation->kode_reservasi }}</td>
                        </tr>
                        <tr>
                            <th>Kucing</th>
                            <td>{{ $catReservation->cat->name }} ({{ $catReservation->cat->breed }})</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kunjungan</th>
                            <td>{{ $catReservation->visit_date->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $catReservation->notes ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status Saat Ini</th>
                            <td>
                                <span class="badge" style="background-color: #FFD85C; color: #2A324C;">
                                    {{ ucfirst($catReservation->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="card border-0 shadow-sm p-4">
                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Informasi Pemesan</h6>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="35%">Nama</th>
                            <td>{{ $catReservation->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $catReservation->user->email }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $catReservation->user->phone ?: '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4">
                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Ubah Status</h6>

                    <form action="{{ route('admin.cat_reservations.update', $catReservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <select name="status" class="form-select">
                                <option value="confirmed" {{ $catReservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="paid" {{ $catReservation->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="completed" {{ $catReservation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $catReservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="expired" {{ $catReservation->status === 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #128965; color: #fff;">
                            Simpan Status
                        </button>
                    </form>

                    <a href="{{ route('admin.cat_reservations.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

    </div>

@else

    {{-- ================= TAMPILAN USER ================= --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card border-0 shadow-sm p-4 mb-3 text-center">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: #128965;"></i>
                    </div>
                    <h4 class="fw-bold mb-1" style="color: #2A324C;">Reservasi Berhasil</h4>
                    <p class="text-muted mb-0">Terima kasih, reservasi Anda telah kami terima.</p>
                </div>

                <div class="card border-0 shadow-sm p-4">
                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Detail Reservasi</h6>
                    <table class="table table-borderless mb-3">
                        <tr>
                            <th width="40%">Kode Reservasi</th>
                            <td>{{ $catReservation->kode_reservasi }}</td>
                        </tr>
                        <tr>
                            <th>Kucing</th>
                            <td>{{ $catReservation->cat->name }} ({{ $catReservation->cat->breed }})</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kunjungan</th>
                            <td>{{ $catReservation->visit_date->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $catReservation->notes ?: '-' }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="color: #2A324C;">Status</span>
                        <span class="badge" style="background-color: #FFD85C; color: #2A324C;">
                            {{ ucfirst($catReservation->status) }}
                        </span>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary flex-fill">Kembali ke Beranda</a>
                    <a href="{{ route('cat_reservations.index') }}" class="btn flex-fill" style="background-color: #128965; color: #fff;">
                        Lihat Riwayat Reservasi
                    </a>
                </div>

            </div>
        </div>
    </div>

@endif

@endsection