@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Detail Pengiriman - PawCare')

@section('content')

@if (Auth::user()->role === 'admin')

    {{-- ================= TAMPILAN ADMIN ================= --}}
    <div class="container-fluid">

        <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
            <h3 class="fw-bold mb-0" style="color: #2A324C;">Detail Pengiriman</h3>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm p-4">
                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Informasi Pengiriman</h6>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="35%">Kode Pesanan</th>
                            <td>{{ $shipment->order->kode_pesanan }}</td>
                        </tr>
                        <tr>
                            <th>Penerima</th>
                            <td>{{ $shipment->order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $shipment->order->shipping_address }}</td>
                        </tr>
                        <tr>
                            <th>Status Saat Ini</th>
                            <td>
                                <span class="badge" style="background-color:
                                    {{ $shipment->status === 'delivered' ? '#128965' : ($shipment->status === 'shipped' ? '#FFD85C' : '#EFEFEF') }};
                                    color: {{ $shipment->status === 'pending' ? '#707378' : ($shipment->status === 'shipped' ? '#2A324C' : '#fff') }};">
                                    {{ ucfirst($shipment->status) }}
                                </span>
                            </td>
                        </tr>
                        @if ($shipment->courier)
                            <tr>
                                <th>Kurir</th>
                                <td>{{ $shipment->courier }}</td>
                            </tr>
                        @endif
                        @if ($shipment->tracking_number)
                            <tr>
                                <th>No. Resi</th>
                                <td>{{ $shipment->tracking_number }}</td>
                            </tr>
                        @endif
                        @if ($shipment->shipped_at)
                            <tr>
                                <th>Dikirim Pada</th>
                                <td>{{ $shipment->shipped_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @endif
                        @if ($shipment->delivered_at)
                            <tr>
                                <th>Diterima Pada</th>
                                <td>{{ $shipment->delivered_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4">
                    <h6 class="fw-bold mb-3" style="color: #2A324C;">Ubah Status</h6>

                    <form action="{{ route('admin.shipments.update', $shipment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label small">Status</label>
                            <select name="status" id="status-select" class="form-select" onchange="toggleShippedFields()">
                                <option value="pending" {{ $shipment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="shipped" {{ $shipment->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $shipment->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>

                        <div id="shipped-fields" style="display: {{ $shipment->status === 'shipped' ? 'block' : 'none' }};">
                            <div class="mb-3">
                                <label class="form-label small">Kurir</label>
                                <input type="text" name="courier" value="{{ old('courier', $shipment->courier) }}"
                                    class="form-control @error('courier') is-invalid @enderror" placeholder="Contoh: JNE, J&T">
                                @error('courier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label small">No. Resi</label>
                                <input type="text" name="tracking_number" value="{{ old('tracking_number', $shipment->tracking_number) }}"
                                    class="form-control @error('tracking_number') is-invalid @enderror">
                                @error('tracking_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #128965; color: #fff;">
                            Simpan Status
                        </button>
                    </form>

                    <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

    </div>

    <script>
        function toggleShippedFields() {
            const status = document.getElementById('status-select').value;
            document.getElementById('shipped-fields').style.display = status === 'shipped' ? 'block' : 'none';
        }
    </script>

@else

    {{-- ================= TAMPILAN USER ================= --}}
    <div class="container py-4">

        <h3 class="fw-bold mb-4" style="color: #2A324C;">Detail Pengiriman</h3>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm p-4">
                    <table class="table table-borderless mb-3">
                        <tr>
                            <th width="40%">Kode Pesanan</th>
                            <td>{{ $shipment->order->kode_pesanan }}</td>
                        </tr>
                        @if ($shipment->courier)
                            <tr>
                                <th>Kurir</th>
                                <td>{{ $shipment->courier }}</td>
                            </tr>
                        @endif
                        @if ($shipment->tracking_number)
                            <tr>
                                <th>No. Resi</th>
                                <td>{{ $shipment->tracking_number }}</td>
                            </tr>
                        @endif
                        @if ($shipment->shipped_at)
                            <tr>
                                <th>Dikirim Pada</th>
                                <td>{{ $shipment->shipped_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @endif
                    </table>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="color: #2A324C;">Status</span>
                        <span class="badge" style="background-color:
                            {{ $shipment->status === 'delivered' ? '#128965' : ($shipment->status === 'shipped' ? '#FFD85C' : '#EFEFEF') }};
                            color: {{ $shipment->status === 'pending' ? '#707378' : ($shipment->status === 'shipped' ? '#2A324C' : '#fff') }};">
                            {{ ucfirst($shipment->status) }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('orders.show', $shipment->order_id) }}" class="btn btn-outline-secondary mt-3">
                    &larr; Kembali ke Detail Pesanan
                </a>
            </div>
        </div>

    </div>

@endif

@endsection