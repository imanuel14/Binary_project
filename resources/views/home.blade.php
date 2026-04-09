@extends('layouts.app')

@section('content')

{{-- Hero Section Minimalis & Terpusat --}}
<section class="hero-about text-center py-5" 
         style="background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9));
                background-size: 300px; 
                background-repeat: no-repeat;
                background-position: center; 
                min-height: 400px; {{-- Tinggi ditambah sesuai masukan 1 --}}
                display: flex; 
                align-items: center; 
                color: #333; {{-- Mengubah teks menjadi gelap agar kontras --}}
                border-bottom: 1px solid #eee;">
    
    <div class="container text-center" data-aos="fade-up">
        
        {{-- Logo Yayasan dengan Soft Shadow --}}
        <div class="mb-5 d-flex justify-content-center">
            <div class="bg-white rounded-circle p-3 shadow" style="width: 120px; height: 120px; border: 1px solid #eee;">
                <img src="{{ asset('images/Logo.Yayasan.png') }}" 
                     alt="Logo Yayasan" 
                     class="img-fluid h-100"
                     style="object-fit: contain;">
            </div>
        </div>

        {{-- Judul Besar --}}
        <h1 class="fw-black mb-3 display-3 text-dark text-uppercase tracking-tighter" style="letter-spacing: -1px;">
            Selamat Datang
        </h1>
        
        {{-- Ayat Alkitab --}}
        <p class="h5 mb-5 text-secondary fw-light italic">
            "Kasihilah Tuhan Allahmu dengan segenap hatimu..."
        </p>
        
        {{-- Tombol Navigasi dengan Efek Hover & Shadow --}}
        <div class="d-flex justify-content-center gap-4 mt-2">
            <a href="{{ route('programs.index') }}" 
               class="btn btn-dark btn-lg px-5 py-3 shadow-lg fw-bold rounded-pill border-0 transition-btn">
                Lihat Program
            </a>
            <a href="{{ route('contact.index') }}" 
               class="btn btn-light btn-lg px-5 py-3 shadow-sm fw-bold rounded-pill border transition-btn" 
               style="background: #ffffff; color: #666;">
                Hubungi Kami
            </a>
        </div>

    </div>
</section>

{{-- Profil Singkat dengan Carousel --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-5 mb-md-0">
                <div id="illustrationCarousel" class="carousel slide carousel-fade shadow-lg rounded-4 overflow-hidden border" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="4000">
                            <img src="{{ asset('images/home/Ambon.Trip.png') }}" class="d-block w-100" alt="Kegiatan Ambon" style="height: 450px; object-fit: cover;">
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <img src="{{ asset('images/home/Wisuda.pdt.png') }}" class="d-block w-100" alt="Wisuda Pendeta" style="height: 450px; object-fit: cover;">
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <img src="{{ asset('images/home/Jakarta.trip.png') }}" class="d-block w-100" alt="Kegiatan Jakarta" style="height: 450px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 ps-md-5">
                <h6 class="text-dark fw-bold text-uppercase small ls-2 mb-2">Profil Singkat</h6>
                <h2 class="fw-bold mb-3 display-6">Mendedikasikan Diri untuk <span class="text-dark border-bottom border-3 border-dark">Kemanusiaan</span></h2>
                <p class="text-muted leading-relaxed">
                    Yayasan Mutiara Kasih Karunia adalah lembaga nirlaba yang berdedikasi untuk memberikan layanan sosial dan pendidikan bagi masyarakat yang membutuhkan, melayani dengan hati yang tulus.
                </p>
                <div class="row mt-4 g-3">
                    <div class="col-6">
                        <div class="p-3 border-start border-3 border-dark bg-light">
                            <h4 class="fw-bold text-dark mb-0">15+</h4>
                            <small class="text-muted fw-bold">Tahun Pengalaman</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border-start border-3 border-dark bg-light">
                            <h4 class="fw-bold text-dark mb-0">500+</h4>
                            <small class="text-muted fw-bold">Anak Didik</small>
                        </div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn btn-dark mt-4 px-4 py-2 rounded-pill shadow">Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

{{-- Section Program Mendatang --}}
<section class="py-5 bg-light border-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold mb-0">Program Mendatang</h2>
                <div class="bg-dark mt-2" style="width: 50px; height: 4px;"></div>
            </div>
            <a href="{{ route('programs.index') }}" class="text-dark fw-bold text-decoration-none small">Semua Program <i class="bi bi-chevron-right"></i></a>
        </div>

        <div class="row g-4">
            @forelse($upcomingPrograms as $program)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow border-0 rounded-4 overflow-hidden card-hover">
                    <div class="position-relative">
                        @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" class="card-img-top" alt="{{ $program->title }}" style="height: 240px; object-fit: cover;">
                        @else
                            <div class="bg-dark text-white text-center py-5" style="height: 240px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-calendar-event fs-1 opacity-25"></i>
                            </div>
                        @endif
                        <span class="position-absolute top-0 start-0 m-3 badge bg-dark px-3 py-2 shadow-sm">
                            {{ ucfirst($program->category) }}
                        </span>
                    </div>

                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark mb-3">{{ $program->title }}</h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($program->description, 100) }}
                        </p>

                        <div class="mt-3 pt-3 border-top border-light">
                            <div class="d-flex align-items-center mb-2 small text-muted">
                                <i class="bi bi-calendar3 me-2 text-dark"></i>
                                {{ $program->schedule_date ? $program->schedule_date->format('d M Y') : 'Segera' }}
                            </div>
                            @if($program->schedule_time)
                            <div class="d-flex align-items-center small text-muted">
                                <i class="bi bi-clock me-2 text-dark"></i>
                                {{ \Carbon\Carbon::parse($program->schedule_time)->format('H:i') }} WIB
                            </div>
                            @endif
                        </div>

                        <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-dark w-100 mt-4 rounded-pill fw-bold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="opacity-25">
                    <i class="bi bi-calendar-x" style="font-size: 4rem;"></i>
                </div>
                <p class="mt-3 text-muted fw-bold">Belum ada program mendatang.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Section Galeri Terkini --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h6 class="text-dark fw-bold text-uppercase small ls-2 mb-2">Dokumentasi</h6>
                <h2 class="fw-bold mb-0 text-dark">Galeri Kegiatan</h2>
                <div class="bg-dark mt-2" style="width: 50px; height: 4px;"></div>
            </div>
            <a href="{{ route('gallery.index') }}" class="text-dark fw-bold text-decoration-none small">Lihat Semua <i class="bi bi-chevron-right"></i></a>
        </div>

        <div class="row g-4">
            @forelse($galleries->take(4) as $item)
            <div class="col-12 col-md-6">
                <div class="gallery-wrapper overflow-hidden rounded-4 shadow-lg position-relative group border" 
                     style="cursor: pointer;"
                     data-bs-toggle="modal" 
                     data-bs-target="#homeGalleryModal"
                     data-image="{{ asset('storage/' . $item->image) }}"
                     data-title="{{ $item->title }}"
                     data-description="{{ $item->description }}">
                    
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         class="img-fluid w-100 gallery-img-home d-block" 
                         alt="{{ $item->title }}"
                         style="height: 450px; object-fit: cover;">
                    
                    <div class="gallery-overlay d-flex align-items-center justify-content-center">
                        <div class="text-center text-white">
                            <i class="bi bi-arrows-angle-expand fs-2 mb-2"></i>
                            <p class="mb-0 fw-bold small text-uppercase tracking-wider">Perbesar Foto</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted italic">Dokumentasi belum tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Modal Detail Galeri --}}
<div class="modal fade" id="homeGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden rounded-4 shadow-lg">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-lg-8 bg-dark d-flex align-items-center justify-content-center" style="min-height: 500px;">
                        <img src="" id="homeModalImage" class="img-fluid w-100" style="max-height: 85vh; object-fit: contain;">
                    </div>
                    <div class="col-lg-4 p-4 p-md-5 bg-white d-flex flex-column justify-content-center">
                        <button type="button" class="btn-close ms-auto mb-4" data-bs-dismiss="modal"></button>
                        <h4 id="homeModalTitle" class="fw-bold text-dark mb-3 display-6"></h4>
                        <div class="bg-dark mb-4" style="width: 40px; height: 3px;"></div>
                        <p id="homeModalDescription" class="text-muted leading-relaxed"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    });
</script>
@endif

{{-- Script untuk Galeri Modal --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homeGalleryModal = document.getElementById('homeGalleryModal');
        
        if (homeGalleryModal) {
            homeGalleryModal.addEventListener('show.bs.modal', function (event) {
                // Elemen yang diklik
                const triggerElement = event.relatedTarget;
                
                // Ambil data atribut
                const imageSrc = triggerElement.getAttribute('data-image');
                const title = triggerElement.getAttribute('data-title');
                const description = triggerElement.getAttribute('data-description');
                
                // Seleksi elemen dalam modal
                const modalImage = homeGalleryModal.querySelector('#homeModalImage');
                const modalTitle = homeGalleryModal.querySelector('#homeModalTitle');
                const modalDescription = homeGalleryModal.querySelector('#homeModalDescription');
                
                // Isi data
                modalImage.src = imageSrc;
                modalTitle.textContent = title;
                modalDescription.textContent = description || 'Tidak ada deskripsi.';
            });
        }
    });
</script>

<style>
    .tracking-wider { letter-spacing: 3px; }
    .card-hover { transition: transform 0.3s ease; }
    .card-hover:hover { transform: translateY(-10px); }
    .transition-btn { transition: all 0.3s ease; }
    .transition-btn:hover { transform: scale(1.05); }
    .ls-2 { letter-spacing: 2px; }
    .leading-relaxed { line-height: 1.8; }

    /* Custom Gallery Styles */
    .gallery-img-home {
        filter: grayscale(100%);
        transition: all 0.7s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .gallery-wrapper:hover .gallery-img-home {
        filter: grayscale(0%);
        transform: scale(1.05);
    }
    .gallery-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.8));
        opacity: 0;
        transition: all 0.4s ease;
    }
    .gallery-wrapper:hover .gallery-overlay {
        opacity: 1;
    }

    /* Styling tambahan untuk mencapai tampilan persis gambar */
    .fw-black { font-weight: 900; }
    .tracking-tighter { letter-spacing: -2px; }
    
    .transition-btn {
        transition: all 0.3s ease;
    }
    
    .transition-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Memastikan font terlihat bersih */
    .hero-section h1 {
        color: #000000;
    }
    
    .hero-section p {
        color: #555555;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

@endsection