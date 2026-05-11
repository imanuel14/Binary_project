@extends('layouts.app')

@section('title', 'Tentang Kami - ' . ($profile->church_name ?? 'Yayasan Mutiara Kasih Karunia'))

@section('content')
<section class="hero-about text-center py-5 position-relative overflow-hidden" 
         style="background: linear-gradient(rgba(255,255,255,0.92), rgba(255,255,255,0.92)), 
                url('{{ $profile && $profile->logo ? asset('storage/' . $profile->logo) : '' }}');
                background-size: 400px; 
                background-repeat: no-repeat;
                background-position: center; 
                min-height: 450px; 
                display: flex; 
                align-items: center; 
                border-bottom: 1px solid #f0f0f0;">
                
    <div class="container" data-aos="fade-up">
        <span class="badge bg-dark text-white mb-3 px-4 py-2 rounded-pill fw-bold text-uppercase tracking-wider shadow-sm" style="font-size: 0.7rem; letter-spacing: 2px;">
            Profil Yayasan
        </span>
        
        <h1 class="display-3 fw-black mb-3 text-dark text-uppercase">Tentang Kami</h1>
        <p class="lead text-secondary mx-auto mb-4" style="max-width: 700px; line-height: 1.6;">
            Mengenal lebih dekat visi, misi, dan nilai-nilai pelayanan di <br>
            <span class="text-dark fw-bold">{{ $profile->church_name ?? 'Yayasan Mutiara Kasih Karunia' }}</span>
        </p>
        
        <div class="mx-auto bg-dark shadow-sm" style="width: 60px; height: 5px; border-radius: 10px;"></div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-lg-4">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    @if($profile && $profile->church_image)
                        <img src="{{ asset('storage/' . $profile->church_image) }}" class="img-fluid rounded-4 shadow-lg border" alt="Foto Gereja" style="width: 100%; height: 400px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center border shadow-sm" style="height: 400px;">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>
                    @endif
                    <div class="position-absolute bottom-0 end-0 bg-dark p-3 rounded-4 shadow-lg d-none d-md-block" style="transform: translate(20px, 20px); z-index: -1; width: 100px; height: 100px;"></div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="fw-bold mb-4 display-6 text-dark">{{ $profile->church_name ?? 'Nama Yayasan' }}</h2>
                
                <div class="card border-0 bg-light rounded-4 p-4 mb-4 shadow-sm transition-hover">
                    <div class="d-flex gap-3">
                        <div class="icon-box bg-white shadow-sm rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="bi bi-eye-fill text-dark fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-2">Visi Kami</h5>
                            <p class="text-muted mb-0" style="font-style: italic;">"{{ $profile->vision ?? 'Visi belum diatur.' }}"</p>
                        </div>
                    </div>
                </div>

                <div class="card border-0 bg-light rounded-4 p-4 shadow-sm transition-hover">
                    <div class="d-flex gap-3">
                        <div class="icon-box bg-white shadow-sm rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="bi bi-rocket-takeoff-fill text-dark fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-2">Misi Kami</h5>
                            <p class="text-muted mb-0" style="white-space: pre-line; line-height: 1.7;">{{ $profile->mission ?? 'Misi belum diatur.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light position-relative">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold display-6">Sejarah Perjalanan</h2>
            <div class="mx-auto bg-dark mt-2" style="width: 40px; height: 3px;"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="zoom-in">
                <div class="card border-0 shadow-sm p-4 p-lg-5 rounded-4 position-relative overflow-hidden">
                    <i class="bi bi-quote text-dark opacity-10 position-absolute" style="font-size: 8rem; top: -20px; right: 10px;"></i>
                    
                    <p class="text-muted text-center position-relative mb-0" style="white-space: pre-line; line-height: 1.9; font-size: 1.05rem;">
                        {{ $profile->history ?? 'Informasi sejarah sedang disusun.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold display-6 mb-2">Pendeta Kami</h2>
            <p class="text-dark small text-uppercase fw-bold ls-2">Pelayanan Utama</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4" data-aos="flip-left">
                <div class="card border-0 shadow-lg text-center rounded-4 p-4 transition-hover overflow-hidden">
                    <div class="card-body">
                        <div class="mb-4 mx-auto bg-light rounded-circle d-flex align-items-center justify-content-center border-4 border-white shadow" 
                             style="width: 150px; height: 150px; overflow: hidden; border: 5px solid white !important;">
                            @if($profile && $profile->pastor_image)
                                <img src="{{ asset('storage/' . $profile->pastor_image) }}" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                            @else
                                <i class="bi bi-person-fill text-secondary" style="font-size: 5rem;"></i>
                            @endif
                        </div>
                        <h4 class="fw-bold text-dark mb-1">{{ $profile->pastor_name ?? 'Nama Pendeta' }}</h4>
                        <span class="badge bg-dark rounded-pill px-4 py-2 mb-3 shadow-sm" style="font-size: 0.7rem;">PENDETA SENIOR</span>
                        <p class="text-muted small lh-lg px-2">
                            Memimpin jemaat dengan penuh kasih dan dedikasi untuk membangun kerajaan Allah di tengah-tengah dunia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .fw-black { font-weight: 900; }
    .ls-2 { letter-spacing: 2.5px; }
    .transition-hover { 
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); 
    }
    .transition-hover:hover { 
        transform: translateY(-12px); 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .icon-box {
        transition: background 0.3s ease;
    }
    /* Hover effect diubah ke background hitam */
    .card:hover .icon-box {
        background-color: #000 !important;
    }
    .card:hover .icon-box i {
        color: white !important;
    }
</style>
@endsection