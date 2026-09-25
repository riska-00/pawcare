@extends('layouts.admin')

@section('title', 'Detail Pembayaran - PawCare')

@section('content')

<div class="container-fluid">

    <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Pembayaran</h3>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4 mb-3">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Informasi Pembayaran</h6>
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="35%">Kode Pesanan</th>
                        <td>{{ $payment->order->kode_pesanan }}</td>
                    </tr>
                    <tr>
                        <th>Pemesan</th>
                        <td>{{ $payment->order->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td class="fw-bold" style="color: #128965;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Metode</th>
                        <td>{{ strtoupper($payment->order->payment_method) }}</td>
                    </tr>
                    <tr>
                        <th>Status Saat Ini</th>
                        <td>
                            <span class="badge" style="background-color:
                                {{ $payment->status === 'confirmed' ? '#128965' : ($payment->status === 'cancelled' ? '#EC5D5D' : '#FFD85C') }};
                                color: {{ $payment->status === 'pending' ? '#2A324C' : '#fff' }};">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                    </tr>
                    @if ($payment->paid_at)
                        <tr>
                            <th>Dikonfirmasi Pada</th>
                            <td>{{ $payment->paid_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endif
                    @if ($payment->confirmedBy)
                        <tr>
                            <th>Dikonfirmasi Oleh</th>
                            <td>{{ $payment->confirmedBy->name }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3" style="color: #2A324C;">Ubah Status</h6>

                <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $payment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $payment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn w-100" style="background-color: #128965; color: #fff;">
                        Simpan Status
                    </button>
                </form>

                <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

</div>

@endsection