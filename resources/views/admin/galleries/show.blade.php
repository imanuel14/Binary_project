@extends('layouts.admin.app')

@section('title', 'Detail Galeri - ' . $gallery->title)

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Galeri</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h2 class="fw-bold text-dark mb-0">{{ $gallery->title }}</h2>
            <p class="text-muted small">Dokumentasi kegiatan gereja</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary btn-sm rounded-3 shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-primary btn-sm rounded-3 shadow-sm">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Kolom Kiri - Gambar Utama & Thumbnail --}}
        <div class="col-lg-8">
            {{-- Gambar Utama --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="position-relative bg-light" style="min-height: 400px;">
                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-100 h-100 object-fit-cover"
                         style="max-height: 500px;"
                         id="mainImage">
                    
                    {{-- Overlay Info --}}
                    <div class="position-absolute bottom-0 start-0 end-0 p-4 bg-gradient-dark">
                        <span class="badge bg-{{ $gallery->status === 'published' ? 'success' : 'warning' }} mb-2">
                            {{ $gallery->status === 'published' ? 'Dipublikasikan' : 'Draft' }}
                        </span>
                        <h4 class="text-white mb-1">{{ $gallery->title }}</h4>
                        <p class="text-white-50 small mb-0">
                            <i class="bi bi-calendar me-1"></i> 
                            {{ $gallery->event_date?->format('d F Y') ?? $gallery->created_at->format('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Galeri Tambahan (Jika ada multiple images) --}}
            @if($gallery->images && count($gallery->images) > 1)
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-images me-2 text-primary"></i>Dokumentasi Lainnya</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($gallery->images as $index => $image)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="position-relative rounded-3 overflow-hidden cursor-pointer hover-zoom"
                                 onclick="changeMainImage('{{ asset('storage/' . $image) }}')">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     class="w-100" 
                                     style="height: 120px; object-fit: cover;"
                                     alt="Gallery {{ $index + 1 }}">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-0 hover-bg-opacity-25 transition-all"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Kolom Kanan - Informasi Detail --}}
        <div class="col-lg-4">
            {{-- Info Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Informasi</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Kategori</span>
                            <span class="fw-semibold">{{ $gallery->category?->name ?? 'Umum' }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Tanggal Kegiatan</span>
                            <span class="fw-semibold">{{ $gallery->event_date?->format('d M Y') ?? '-' }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Dibuat</span>
                            <span class="fw-semibold">{{ $gallery->created_at->format('d M Y H:i') }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Terakhir Diupdate</span>
                            <span class="fw-semibold">{{ $gallery->updated_at->format('d M Y H:i') }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2">
                            <span class="text-muted">Dibuat Oleh</span>
                            <span class="fw-semibold">{{ $gallery->user?->name ?? 'Admin' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-file-text me-2 text-primary"></i>Deskripsi</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        {{ $gallery->description ?? 'Tidak ada deskripsi untuk galeri ini.' }}
                    </p>
                </div>
            </div>

            {{-- Tags --}}
            @if($gallery->tags && count($gallery->tags) > 0)
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-tags me-2 text-primary"></i>Tags</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($gallery->tags as $tag)
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- Statistik --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-bar-chart me-2 text-primary"></i>Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <h4 class="fw-bold text-primary mb-1">{{ $gallery->views ?? 0 }}</h4>
                            <small class="text-muted">Dilihat</small>
                        </div>
                        <div class="col-4 border-start">
                            <h4 class="fw-bold text-success mb-1">{{ $gallery->likes ?? 0 }}</h4>
                            <small class="text-muted">Suka</small>
                        </div>
                        <div class="col-4 border-start">
                            <h4 class="fw-bold text-info mb-1">{{ $gallery->downloads ?? 0 }}</h4>
                            <small class="text-muted">Unduhan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Preview Gambar --}}
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img src="" id="modalImage" class="img-fluid" style="max-height: 80vh;">
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .hover-zoom:hover img {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .hover-bg-opacity-25:hover {
        background-color: rgba(0,0,0,0.25) !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Ganti gambar utama saat thumbnail diklik
    function changeMainImage(src) {
        document.getElementById('mainImage').src = src;
    }

    // Modal preview
    document.getElementById('mainImage').addEventListener('click', function() {
        document.getElementById('modalImage').src = this.src;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    });
</script>
@endpush
@endsection