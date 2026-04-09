@extends('layouts.admin.app') {{-- Pastikan mengarah ke layout admin Anda --}}

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold text-dark">Edit Dokumentasi Galeri</h2>
            <p class="text-muted small">Perbarui informasi foto untuk koleksi Visual Archive</p>
        </div>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary btn-sm rounded-3 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Judul Dokumentasi</label>
                            <input type="text" name="title" class="form-control form-control-lg bg-light border-0 @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $gallery->title) }}" placeholder="Contoh: Ibadah Minggu Raya">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-dark">Kategori</label>
                                <select name="category" class="form-select bg-light border-0 py-2 @error('category') is-invalid @enderror">
                                    <option value="pendidikan" {{ $gallery->category == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="sosial" {{ $gallery->category == 'sosial' ? 'selected' : '' }}>Sosial</option>
                                    <option value="pelayanan" {{ $gallery->category == 'pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                                    <option value="event" {{ $gallery->category == 'event' ? 'selected' : '' }}>Event</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-dark">Tanggal Kegiatan</label>
                                <input type="date" name="event_date" class="form-control bg-light border-0 py-2" 
                                       value="{{ old('event_date', $gallery->event_date ? $gallery->event_date->format('Y-m-d') : '') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Deskripsi Singkat</label>
                            <textarea name="description" rows="5" class="form-control bg-light border-0" 
                                      placeholder="Ceritakan sedikit tentang momen ini...">{{ old('description', $gallery->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Ganti Foto (Opsional)</label>
                            <input type="file" name="image" class="form-control bg-light border-0 @error('image') is-invalid @enderror">
                            <div class="form-text text-muted">Format: JPG, PNG, WEBP. Maks: 2MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3 py-3">
                                <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold text-dark mb-0">Preview Saat Ini</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="preview-container rounded-4 overflow-hidden mb-3 shadow-sm" style="aspect-ratio: 1/1;">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             class="img-fluid w-100 h-100 object-fit-cover grayscale-preview" 
                             alt="Preview">
                    </div>
                    <p class="text-muted small">Foto ini akan tampil dalam mode monokrom di galeri publik.</p>
                </div>
            </div>

            <div class="card border-0 bg-dark text-white rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Tips Admin</h6>
                    <ul class="small ps-3 mb-0 text-white-50">
                        <li class="mb-2">Gunakan foto beresolusi tinggi untuk hasil terbaik.</li>
                        <li class="mb-2">Kategori akan menentukan di mana foto muncul pada filter publik.</li>
                        <li>Pastikan judul menarik untuk meningkatkan interaksi jemaat.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling agar selaras dengan dasbor admin */
    .bg-light { background-color: #f8f9fa !important; }
    .object-fit-cover { object-fit: cover; }
    
    /* Efek preview monokrom agar admin tahu hasilnya */
    .grayscale-preview {
        filter: grayscale(100%);
    }

    /* Menghilangkan border focus default agar terlihat lebih modern */
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        background-color: #f1f3f5 !important;
        border: 1px solid #dee2e6 !important;
    }

    .btn-primary {
        background-color: #1a1d23;
        border: none;
    }
    .btn-primary:hover {
        background-color: #2d323a;
    }
</style>
@endsection