@extends('layouts.app')

@section('title', 'Galeri ' . ucfirst($category) . ' - Yayasan Mutiara Kasih Karunia')

@section('content')
<div class="bg-white min-vh-100 py-5">
    <div class="container py-4">
        
        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div style="height: 1px; width: 30px; background-color: #1a1d23;"></div>
                <span class="text-uppercase tracking-widest text-dark small fw-bold">Visual Archive</span>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}" class="text-decoration-none text-muted">Galeri</a></li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">{{ ucfirst($category) }}</li>
                </ol>
            </nav>
        </div>

        <div class="mb-5">
            <h1 class="display-3 fw-black text-dark mb-3" style="letter-spacing: -3px;">
                {{ ucfirst($category) }}
            </h1>
            <p class="text-secondary col-lg-7 fs-5">
                Koleksi dokumentasi pilihan yang merangkum dampak kami dalam bidang **{{ $category }}**. Setiap bingkai menceritakan kisah dedikasi dan pertumbuhan komunitas.
            </p>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-5">
            <a href="{{ route('gallery.index') }}" 
               class="btn btn-gallery-filter {{ !request('category') ? 'active' : '' }}">All Collections</a>
            
            <a href="{{ route('gallery.category', 'pendidikan') }}" 
               class="btn btn-gallery-filter {{ $category == 'pendidikan' ? 'active' : '' }}">Pendidikan</a>
            
            <a href="{{ route('gallery.category', 'sosial') }}" 
               class="btn btn-gallery-filter {{ $category == 'sosial' ? 'active' : '' }}">Sosial</a>
            
            <a href="{{ route('gallery.category', 'pelayanan') }}" 
               class="btn btn-gallery-filter {{ $category == 'pelayanan' ? 'active' : '' }}">Pelayanan</a>
            
            <a href="{{ route('gallery.category', 'event') }}" 
               class="btn btn-gallery-filter {{ $category == 'event' ? 'active' : '' }}">Event</a>
        </div>

        <div class="row g-4">
            @forelse($galleries as $gallery)
            <div class="col-md-6 col-lg-4">
                <div class="gallery-item cursor-pointer" onclick="openModal('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title }}', '{{ $gallery->category }}')">
                    <div class="gallery-img-container mb-3 shadow-sm">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}" 
                             class="img-fluid gallery-img-mono">
                        <div class="gallery-hover-icon">
                            <i class="bi bi-box-arrow-up-right"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-start px-1">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">{{ $gallery->title }}</h5>
                            <p class="small text-muted text-uppercase tracking-tighter mb-0">
                                {{ $gallery->category }} • {{ $gallery->created_at->format('Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada foto untuk kategori {{ $category }}.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $galleries->links() }}
        </div>
    </div>
</div>

<style>
    /* Tipografi & Dasar */
    .fw-black { font-weight: 900; }
    .tracking-widest { letter-spacing: 0.2em; }
    .tracking-tighter { letter-spacing: -0.5px; }
    .cursor-pointer { cursor: pointer; }

    /* Tombol Filter Pill */
    .btn-gallery-filter {
        border-radius: 50px;
        padding: 8px 24px;
        background-color: #ffffff;
        color: #1a1d23;
        border: 1px solid #dee2e6;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    .btn-gallery-filter:hover, .btn-gallery-filter.active {
        background-color: #1a1d23;
        color: #ffffff !important;
        border-color: #1a1d23;
    }

    /* Container Gambar */
    .gallery-img-container {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        aspect-ratio: 1 / 1;
        background-color: #f8f9fa;
    }

    /* Efek Monokrom */
    .gallery-img-mono {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .gallery-item:hover .gallery-img-mono {
        filter: grayscale(0%);
        transform: scale(1.05);
    }

    /* Hover Icon */
    .gallery-hover-icon {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: white;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .gallery-item:hover .gallery-hover-icon {
        opacity: 1;
        transform: translateY(0);
    }

    /* Custom Breadcrumb */
    .breadcrumb-item + .breadcrumb-item::before {
        content: "/";
        color: #dee2e6;
    }
</style>
@endsection