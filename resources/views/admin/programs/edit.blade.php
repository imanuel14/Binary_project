@extends('layouts.admin.app')

@section('title', 'Edit Program')
@section('header', 'Edit Program')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Edit Program: {{ $program->title }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data">
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
                  <option value="" disabled selected>-- Pilih Kategori --</option>
                <option value="ibadah" {{ old('category') == 'ibadah' ? 'selected' : '' }}>Ibadah</option>
              <option value="pendidikan" {{ old('category') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
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
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $program->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="ibadah" {{ old('category', $program->category) == 'ibadah' ? 'selected' : '' }}>Ibadah</option>
                            <option value="pendidikan" {{ old('category', $program->category) == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="schedule_date" class="form-control"
                                   value="{{ old('schedule_date', $program->schedule_date ? \Carbon\Carbon::parse($program->schedule_date)->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Waktu</label>
                            <input type="time" name="schedule_time" class="form-control"
                                   value="{{ old('schedule_time', $program->schedule_time) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Lokasi</label>
                        <input type="text" name="location" class="form-control"
                               value="{{ old('location', $program->location) }}">
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

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection