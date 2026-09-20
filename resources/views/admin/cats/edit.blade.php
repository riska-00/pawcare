@extends('layouts.admin')

@section('title', 'Edit Kucing - PawCare Admin')

@section('content')

<div class="container-fluid">

    <div class="p-3 rounded mb-4" style="background-color: #FFD85C;">
        <h3 class="fw-bold mb-0" style="color: #2A324C;">Edit Kucing</h3>
    </div>

    <div class="card shadow-sm border-0">

        <form action="{{ route('admin.cats.update', $cat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-header py-3" style="background-color: #FFEBA6;">
                <h6 class="m-0 fw-bold" style="color: #2A324C;"> Form Kucing </h6>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $cat->name) }}"
                      class="form-control @error('name') is-invalid @enderror">
                    
                    @error('name')
                         <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ras</label>
                        <input type="text" name="breed" value="{{ old('breed', $cat->breed) }}"
                            class="form-control @error('breed') is-invalid @enderror">
                        
                        @error('breed')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="col-md-6 mb-3">
                        <label class="form-label">Usia</label>
                        <input type="text" name="age" value="{{ old('age', $cat->age) }}"
                            class="form-control @error('age') is-invalid @enderror">
                        
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                            <option value="jantan" {{ old('gender', $cat->gender) === 'jantan' ? 'selected' : '' }}>Jantan</option>
                            <option value="betina" {{ old('gender', $cat->gender) === 'betina' ? 'selected' : '' }}>Betina</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price" value="{{ old('price', $cat->price) }}"
                                class="form-control @error('price') is-invalid @enderror">
                        </div>
                        @error('price')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="available" {{ old('status', $cat->status) === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="reserved" {{ old('status', $cat->status) === 'reserved' ? 'selected' : '' }}>Reserved</option>
                            <option value="sold" {{ old('status', $cat->status) === 'sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto Saat Ini</label>
                        <div>
                            @if ($cat->photo)
                                <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}"
                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                                    style="width: 80px; height: 80px; border-radius: 8px; font-size: 0.7rem;">
                                    No Photo
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
 
                <div class="mb-3">
                    <label class="form-label">Ganti Foto (opsional)</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti foto.</div>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
 
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $cat->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
 
            </div>
 
            <div class="card-footer d-flex gap-2">
                <button type="submit" class="btn" style="background-color: #128965; color: #fff;">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('cats.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
 
        </form>
 
    </div>
 
</div>
@endsection