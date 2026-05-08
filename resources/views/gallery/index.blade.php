@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<div class="container py-5">
    <div class="mb-5">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="height: 1px; width: 30px; background-color: #dee2e6;"></div>
            <span class="text-uppercase tracking-widest text-secondary small fw-bold">Visual Archive</span>
        </div>
        <h1 class="display-4 fw-black text-dark mb-3" style="letter-spacing: -2px;">Gallery yayasan</h1>
        <p class="text-secondary col-lg-6 fs-5">A curated monochrome collection capturing our impact. Every frame tells a story of dedication and growth.</p>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-5">
        <a href="{{ route('gallery.index') }}" class="btn btn-gallery-filter {{ !request('category') ? 'active' : '' }}">All Collections</a>
        @foreach(['Pendidikan', 'Sosial', 'Pelayanan', 'Event'] as $cat)
            <a href="{{ route('gallery.category', strtolower($cat)) }}" 
               class="btn btn-gallery-filter {{ request('category') == strtolower($cat) ? 'active' : '' }}">
               {{ $cat }}
            </a>
        @endforeach
    </div>

    <div class="row g-4">
        @foreach($galleries as $gallery)
        <div class="col-md-6 col-lg-4">
            <div class="gallery-item group">
                <a href="{{ asset('storage/' . $gallery->image) }}" 
                   class="glightbox" 
                   data-gallery="gallery-{{ $gallery->id }}" 
                   data-title="{{ $gallery->title }}" 
                   data-description=".desc-{{ $gallery->id }}">
                    
                    <div class="gallery-img-wrapper mb-3">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="img-fluid gallery-img">
                        <div class="gallery-icon">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </div>
                    </div>
                </a>

                <div class="glightbox-desc desc-{{ $gallery->id }}" style="display: none;">
                    <div class="p-3">
                        <h4 class="fw-bold text-dark">{{ $gallery->title }}</h4>
                        <p class="text-muted small text-uppercase mb-3">{{ $gallery->category }}</p>
                        <p class="text-secondary lh-base">{{ $gallery->description }}</p>
                    </div>
                </div>

                <div style="display:none;">
                    @foreach($gallery->images as $extra)
                        <a href="{{ asset('storage/' . $extra->path) }}" 
                           class="glightbox" 
                           data-gallery="gallery-{{ $gallery->id }}"
                           data-title="{{ $gallery->title }}"
                           data-description=".desc-{{ $gallery->id }}">
                        </a>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">{{ $gallery->title }}</h5>
                        <p class="small text-muted text-uppercase mb-0">
                            {{ $gallery->category }} • {{ $gallery->event_date ? \Carbon\Carbon::parse($gallery->event_date)->format('Y') : '2024' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            // Mengatur posisi deskripsi di kanan secara permanen
            descPosition: 'right', 
            width: 'auto', // Biarkan lebar menyesuaikan konten
            height: '85vh',
            zoomable: true,
            draggable: true,
            // Menambah efek transisi yang hanya fokus pada gambar
            openEffect: 'zoom',
            closeEffect: 'fade',
            slideEffect: 'slide', // Efek geser hanya untuk elemen gambar
        });
    });
</script>
<style>
    .fw-black { font-weight: 900; }
    .btn-gallery-filter {
        border-radius: 50px; padding: 8px 24px; background-color: #f8f9fa;
        color: #6c757d; border: 1px solid #dee2e6; font-weight: 600;
        font-size: 0.9rem; transition: all 0.3s ease; text-decoration: none;
    }
    .btn-gallery-filter:hover, .btn-gallery-filter.active {
        background-color: #1a1d23; color: white; border-color: #1a1d23;
    }
    .gallery-img-wrapper {
        position: relative; border-radius: 12px; overflow: hidden;
        aspect-ratio: 1 / 1; cursor: pointer;
    }
    .gallery-img {
        width: 100%; height: 100%; object-fit: cover;
        filter: grayscale(100%); transition: all 0.5s ease;
    }
    .gallery-item:hover .gallery-img {
        filter: grayscale(0%); transform: scale(1.05);
    }
    .gallery-icon {
        position: absolute; bottom: 15px; right: 15px; background: white;
        width: 35px; height: 35px; border-radius: 8px; display: flex;
        align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;
    }
    .gallery-item:hover .gallery-icon { opacity: 1; }

    /* Custom CSS untuk memperlebar area deskripsi di sisi kanan */
    .glightbox-container .gslide-description {
        background: #ffffff !important;
        max-width: 400px !important; 
        border-left: 1px solid #eee;
    }
    .glightbox-container .gdesc-inner {
        padding: 30px !important;
    }
</style>
@endsection