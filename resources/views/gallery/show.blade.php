@extends('layouts.app')

@section('title', $gallery->title . ' - Detail Galeri')

@section('content')
<div class="bg-white min-vh-100 py-5">
    <div class="container py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <a href="{{ route('gallery.category', $gallery->category) }}" class="btn btn-outline-dark rounded-pill px-4 btn-sm">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke {{ ucfirst($gallery->category) }}
            </a>
            <div class="d-flex align-items-center gap-2">
                <span class="text-uppercase tracking-widest text-muted small fw-bold">Archive Detail</span>
                <div style="height: 1px; width: 30px; background-color: #dee2e6;"></div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="detail-img-wrapper shadow-lg">
                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="img-fluid gallery-detail-img">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ps-lg-4">
                    <div class="mb-4">
                        <span class="badge rounded-pill bg-dark px-3 py-2 text-uppercase mb-3" style="letter-spacing: 1px;">
                            {{ $gallery->category }}
                        </span>
                        <h1 class="display-5 fw-black text-dark mb-3" style="letter-spacing: -2px; line-height: 1;">
                            {{ $gallery->title }}
                        </h1>
                        <p class="text-muted fw-bold small text-uppercase tracking-wider">
                            Dokumentasi • {{ $gallery->created_at->format('d F Y') }}
                        </p>
                    </div>

                    <hr class="my-4 opacity-10">

                    <div class="mb-5">
                        <h6 class="fw-bold text-dark text-uppercase small mb-3">Tentang Kegiatan</h6>
                        <p class="text-secondary leading-relaxed fs-6">
                            {{ $gallery->description ?? 'Tidak ada deskripsi tambahan untuk dokumentasi ini. Setiap momen yang ditangkap merupakan bagian dari perjalanan pelayanan Yayasan Mutiara Kasih Karunia.' }}
                        </p>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ asset('storage/' . $gallery->image) }}" download class="btn btn-dark py-3 fw-bold rounded-3">
                            <i class="bi bi-download me-2"></i>Unduh Gambar
                        </a>
                        <button class="btn btn-light py-3 fw-bold rounded-3 border" onclick="window.print()">
                            <i class="bi bi-printer me-2"></i>Cetak Dokumentasi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($relatedGalleries) && $relatedGalleries->count() > 0)
        <div class="mt-5 pt-5 border-top">
            <h4 class="fw-black text-dark mb-4">Foto Terkait</h4>
            <div class="row g-3">
                @foreach($relatedGalleries as $related)
                <div class="col-6 col-md-3">
                    <a href="{{ route('gallery.show', $related->id) }}" class="text-decoration-none">
                        <div class="related-img-wrapper rounded-3 overflow-hidden shadow-sm">
                            <img src="{{ asset('storage/' . $related->image) }}" class="img-fluid grayscale-related" alt="{{ $related->title }}">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .fw-black { font-weight: 900; }
    .tracking-widest { letter-spacing: 0.2em; }
    .leading-relaxed { line-height: 1.8; }

    /* Wrapper Detail Gambar */
    .detail-img-wrapper {
        border-radius: 20px;
        overflow: hidden;
        background-color: #f8f9fa;
    }

    /* Efek Monokrom Detail */
    .gallery-detail-img {
        width: 100%;
        filter: grayscale(100%);
        transition: filter 0.8s ease;
    }
    .detail-img-wrapper:hover .gallery-detail-img {
        filter: grayscale(0%);
    }

    /* Foto Terkait Grayscale */
    .grayscale-related {
        filter: grayscale(100%);
        transition: 0.3s ease;
        aspect-ratio: 1/1;
        object-fit: cover;
    }
    .grayscale-related:hover {
        filter: grayscale(0%);
    }

    /* Responsif untuk Mobile */
    @media (max-width: 991.98px) {
        .display-5 { font-size: 2.5rem; }
    }
</style>
@endsection