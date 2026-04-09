@extends('layouts.app')

@section('title', 'Program - Yayasan Mutiara Kasih Karunia')

@section('content')

{{-- Hero Section Utama - Versi Putih Bersih --}}
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
    
    <div class="container" data-aos="fade-up">
        {{-- Judul Besar dengan Warna Gelap --}}
        <h1 class="fw-bold display-4 text-uppercase text-dark tracking-wider" style="letter-spacing: 2px;">
            {{ 'Semua Program' }}
        </h1>
        
        {{-- Garis Dekoratif Pendek --}}
        <div class="bg-dark mx-auto mt-3 mb-4" style="width: 60px; height: 4px; border-radius: 2px;"></div>
        
        {{-- Deskripsi dengan Warna Abu-abu --}}
        <p class="lead text-muted fw-light">
            {{ 'Daftar lengkap seluruh kegiatan yayasan kami' }}
        </p>
    </div>
</section>

<div class="container py-5">
    {{-- Filter Navigasi --}}
    <div class="row mb-5">
        <div class="col-md-6 mx-auto">
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('programs.index') }}" 
                   class="btn {{ request()->routeIs('programs.index') ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 shadow-sm">
                   Semua
                </a>
                <a href="{{ route('programs.ibadah') }}" 
                   class="btn {{ request()->is('*ibadah*') ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 shadow-sm">
                   Ibadah
                </a>
                <a href="{{ route('programs.pendidikan') }}" 
                   class="btn {{ request()->is('*pendidikan*') ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 shadow-sm">
                   Pendidikan
                </a>
            </div>
        </div>
    </div>

    {{-- Grid Program --}}
    <div class="row g-4">
        @forelse($programs as $program)
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden card-hover">
                {{-- Bagian Gambar --}}
                <div class="position-relative">
                    @if($program->image)
                        <img src="{{ asset('storage/' . $program->image) }}" class="card-img-top" alt="{{ $program->title }}" style="height: 220px; object-fit: cover;">
                    @else
                        <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                            <i class="bi bi-calendar-event fs-1 opacity-25"></i>
                        </div>
                    @endif
                    
                    {{-- Badge Kategori --}}
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge {{ $program->category == 'ibadah' ? 'bg-primary' : 'bg-success' }} px-3 py-2 rounded-pill shadow-sm fw-bold">
                            {{ ucfirst($program->category) }}
                        </span>
                    </div>
                </div>

                {{-- Bagian Isi --}}
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3 text-dark">{{ $program->title }}</h5>
                    <p class="card-text text-muted small flex-grow-1">
                        {{ Str::limit($program->description, 110) }}
                    </p>
                    
                    {{-- Detail Waktu & Lokasi --}}
                    <div class="mt-3 pt-3 border-top">
                        <ul class="list-unstyled mb-4 small text-muted">
                            @if($program->schedule_date)
                            <li class="mb-2 d-flex align-items-center">
                                <i class="bi bi-calendar3 me-2 text-dark"></i>
                                {{ $program->schedule_date->format('d M Y') }}
                            </li>
                            @endif
                            
                            @if($program->schedule_time)
                            <li class="mb-2 d-flex align-items-center">
                                <i class="bi bi-clock me-2 text-dark"></i>
                                {{ \Carbon\Carbon::parse($program->schedule_time)->format('H:i') }} WIB
                            </li>
                            @endif
                            
                            @if($program->location)
                            <li class="d-flex align-items-center">
                                <i class="bi bi-geo-alt me-2 text-danger"></i>
                                {{ $program->location }}
                            </li>
                            @endif
                        </ul>

                        <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-dark w-100 rounded-pill fw-bold transition-btn">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="opacity-25 mb-3">
                <i class="bi bi-inbox" style="font-size: 4rem;"></i>
            </div>
            <p class="text-muted fw-bold">Belum ada program tersedia saat ini.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $programs->links() }}
    </div>
</div>

<style>
    .tracking-wider { letter-spacing: 3px; }
    .card-hover { 
        transition: all 0.3s ease; 
    }
    .card-hover:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; 
    }
    .transition-btn { 
        transition: all 0.3s ease; 
    }
    .transition-btn:hover { 
        background-color: #212529; 
        color: white; 
    }
    /* Mengubah warna pagination Laravel agar selaras dengan tema gelap */
    .pagination .page-item.active .page-link {
        background-color: #212529;
        border-color: #212529;
    }
    .pagination .page-link {
        color: #212529;
    }
</style>

@endsection