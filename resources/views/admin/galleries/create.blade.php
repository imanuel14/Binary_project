@extends('layouts.admin.app')

@section('title', 'Tambah Foto Galeri')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Foto Baru</h1>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Judul Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                                    <option value="ibadah" {{ old('category') == 'ibadah' ? 'selected' : '' }}>Ibadah</option>
                                    <option value="pendidikan" {{ old('category') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="sosial" {{ old('category') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                                    <option value="pemuda" {{ old('category') == 'pemuda' ? 'selected' : '' }}>Pemuda</option>
                                    <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tanggal Kegiatan</label>
                                <input type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}">
                                @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Urutan Tampil</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox mt-4">
                                    <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Tampilkan di galeri</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ⭐ MULTIPLE IMAGE UPLOAD SECTION --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Foto <span class="text-danger">*</span></label>
                            
                            {{-- Input multiple files --}}
                            <div class="custom-file">
                                <input type="file" 
                                       name="images[]" 
                                       class="custom-file-input @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" 
                                       id="images" 
                                       accept="image/*" 
                                       multiple 
                                       required 
                                       onchange="previewMultipleImages(this)">
                                <label class="custom-file-label" for="images" id="fileLabel">Pilih file...</label>
                                @error('images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <small class="form-text text-muted">
                                Format: JPG, PNG, GIF. Max 5MB per file. 
                                <span class="text-primary font-weight-bold">Bisa pilih banyak file sekaligus!</span>
                            </small>
                            
                            {{-- Preview Container --}}
                            <div class="mt-3 border p-2 rounded" id="previewContainer">
                                <p class="text-muted text-center mb-0" id="noPreview">Belum ada foto dipilih</p>
                                <div class="row g-2" id="previewRow"></div>
                            </div>
                            
                            {{-- Image Counter --}}
                            <div class="mt-2 text-right">
                                <span class="badge badge-info" id="imageCounter">0 foto dipilih</span>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Simpan Foto
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function previewMultipleImages(input) {
    const previewRow = document.getElementById('previewRow');
    const noPreview = document.getElementById('noPreview');
    const fileLabel = document.getElementById('fileLabel');
    const imageCounter = document.getElementById('imageCounter');
    
    // Clear previous previews
    previewRow.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        // Hide "no preview" message
        noPreview.style.display = 'none';
        
        // Update label and counter
        const fileCount = input.files.length;
        fileLabel.textContent = fileCount + ' file dipilih';
        imageCounter.textContent = fileCount + ' foto dipilih';
        
        // Loop through each file
        Array.from(input.files).forEach((file, index) => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-6 mb-2';
                
                col.innerHTML = `
                    <div class="position-relative border rounded overflow-hidden">
                        <img src="${e.target.result}" class="img-fluid w-100" style="height: 100px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white text-center py-1" style="font-size: 10px;">
                            ${file.name.substring(0, 15)}${file.name.length > 15 ? '...' : ''}
                        </div>
                        ${index === 0 ? '<div class="position-absolute top-0 start-0 bg-primary text-white px-2 py-1" style="font-size: 10px;">Utama</div>' : ''}
                    </div>
                `;
                
                previewRow.appendChild(col);
            };
            
            reader.readAsDataURL(file);
        });
    } else {
        // Reset if no files
        noPreview.style.display = 'block';
        fileLabel.textContent = 'Pilih file...';
        imageCounter.textContent = '0 foto dipilih';
    }
}
</script>
@endsection