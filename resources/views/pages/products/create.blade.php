@extends('layouts.admin')

@section('title', 'Tambah Produk - PawCare Admin')

@section('content')

<div class="container-fluid">

    <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Tambah Produk</h3>
    </div>

    <div class="card shadow-sm border-0">

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-header py-3" style="background-color: #FFEBA6;">
                <h6 class="m-0 fw-bold" style="color: #2A324C;">Form Produk</h6>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama produk">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                            class="form-control @error('category') is-invalid @enderror" placeholder="Contoh: Makanan">
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price" value="{{ old('price') }}"
                                class="form-control @error('price') is-invalid @enderror" placeholder="0">
                        </div>
                        @error('price')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock') }}"
                        class="form-control @error('stock') is-invalid @enderror" placeholder="0">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Ceritakan tentang produk ini">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer d-flex gap-2">
                <button type="submit" class="btn" style="background-color: #128965; color: #fff;">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection