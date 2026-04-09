@extends('layouts.app')

@section('content')

{{-- Hero Section Khusus Pendidikan --}}
<section class="py-5 text-center shadow-sm" 
         style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                url('{{ asset('images/bg-Yayasan.jpg') }}'), 
                #333; /* Menambahkan warna gelap sebagai cadangan */
                background-size: cover; 
                background-position: center; 
                min-height: 300px; 
                display: flex; 
                align-items: center; 
                color: white;">
    <div class="container" data-aos="fade-up">
        <h1 class="fw-bold display-4 text-uppercase tracking-wider">Program Pendidikan</h1>
        <p class="lead opacity-90">"Membentuk generasi yang cerdas, berkarakter, dan takut akan Tuhan."</p>
    </div>
</section>

{{-- Konten Utama --}}
<section class="py-5 bg-light">
    <div class="container">
        {{-- Navigasi Kategori --}}
        <div class="d-flex justify-content-center gap-2 mb-5">
            <a href="{{ route('programs.index') }}" class="btn btn-outline-dark rounded-pill px-4">Semua</a>
            <a href="{{ url('/programs/category/ibadah') }}" class="btn btn-outline-dark rounded-pill px-4">Ibadah</a>
            <a href="#" class="btn btn-dark rounded-pill px-4 active shadow">Pendidikan</a>
        </div>

        <div class="row g-4">
            @forelse($programs as $program)
                <div class="col-md-6 col-lg-4" data-aos="zoom-in">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden card-hover">
                        <div class="position-relative">
                            @if($program->image)
                                <img src="{{ asset('storage/' . $program->image) }}" class="card-img-top" alt="{{ $program->title }}" style="height: 220px; object-fit: cover;">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                                    <i class="bi bi-book-half fs-1 opacity-25"></i>
                                </div>
                            @endif
                            {{-- Label Status/Tingkatan --}}
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary shadow-sm px-3 py-2 rounded-pill">
                                    Pendidikan
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold mb-3 text-dark">{{ $program->title }}</h5>
                            <p class="text-muted small mb-4 flex-grow-1">
                                {{ Str::limit($program->description, 120) }}
                            </p>
                            
                            <div class="p-3 bg-white border rounded-3 mb-4 shadow-sm">
                                <div class="d-flex align-items-center mb-2 small">
                                    <i class="bi bi-mortarboard me-2 text-primary"></i>
                                    <strong>Target:</strong> &nbsp; {{ $program->target_audience ?? 'Anak-anak & Remaja' }}
                                </div>
                                <div class="d-flex align-items-center small text-muted">
                                    <i class="bi bi-geo-alt me-2 text-danger"></i>
                                    {{ $program->location ?? 'Aula Yayasan' }}
                                </div>
                            </div>

                            <a href="{{ route('programs.show', $program) }}" class="btn btn-dark w-100 rounded-pill fw-bold transition-btn">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="opacity-25 mb-3">
                        <i class="bi bi-journal-x" style="font-size: 4rem;"></i>
                    </div>
                    <p class="text-muted fw-bold">Belum ada program pendidikan yang terdaftar saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .card-hover { 
        transition: all 0.3s cubic-bezier(.25,.8,.25,1); 
    }
    .card-hover:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; 
    }
    .tracking-wider { letter-spacing: 3px; }
    .transition-btn { transition: all 0.3s ease; }
    .transition-btn:hover { background-color: #333; transform: scale(1.02); }
</style>

@endsection