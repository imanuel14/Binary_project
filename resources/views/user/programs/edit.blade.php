@extends('layouts.user.app')

@section('title', 'Edit Program')
@section('header', 'Edit Program')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Edit Program: {{ $program->title }}</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('user.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">
                            Kategori Program <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" 
                                name="category" 
                                required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <option value="ibadah" {{ old('category', $program->category) == 'ibadah' ? 'selected' : '' }}>Ibadah</option>
                            <option value="pendidikan" {{ old('category', $program->category) == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Program</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $program->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <phone-textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $program->description) }}</phone-textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="schedule_date" class="form-control @error('schedule_date') is-invalid @enderror"
                                   value="{{ old('schedule_date', $program->schedule_date ? \Carbon\Carbon::parse($program->schedule_date)->format('Y-m-d') : '') }}">
                            @error('schedule_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Waktu</label>
                            <input type="time" name="schedule_time" class="form-control @error('schedule_time') is-invalid @enderror"
                                   value="{{ old('schedule_time', $program->schedule_time) }}">
                            @error('schedule_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Lokasi</label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                               value="{{ old('location', $program->location) }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Gambar Program</label>

                        @if($program->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $program->image) }}" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                        @endif

                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="{{ route('user.programs.index') }}" class="btn btn-secondary px-4">Kembali</a>
                        <button type="submit" class="btn btn-warning px-4 fw-bold">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection