@extends('layouts.app')

@section('title', $program->title . ' - Yayasan Mutiara Kasih Karunia')

@section('content')

@if($program->category == 'pendidikan')
    {{-- ========================================== --}}
    {{-- TAMPILAN PROGRAM PENDIDIKAN (Gaya Sekolah) --}}
    {{-- ========================================== --}}
    
    {{-- 1. HERO SECTION --}}
    <div class="bg-white py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-success px-3 py-2 mb-3 shadow-sm">Sektor Pendidikan</span>
                    <h1 class="display-4 fw-bold text-dark mb-3">{{ $program->title }}</h1>
                    <p class="lead text-secondary mb-4">
                        Membentuk karakter mulia dan kreativitas anak sejak dini melalui pendekatan kasih dan pendidikan yang holistik.
                    </p>
                    <div class="d-flex gap-3">
                        {{-- Anchor Link ke ID #daftar-form --}}
                        <a href="#daftar-form" class="btn btn-dark px-4 py-2 fw-bold">Daftar Sekarang</a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-dark px-4 py-2 fw-bold">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light rounded-4 shadow-sm overflow-hidden" style="height: 380px; border: 1px solid #eee;">
                        @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. PROFIL SECTION --}}
    <div class="py-5 bg-white border-top">
        <div class="container text-center py-4">
            <h2 class="fw-bold mb-4">Profil {{ $program->title }}</h2>
            <div class="row justify-content-center">
                <div class="col-lg-9 text-secondary lh-lg fs-5">
                    {{ $program->description }}
                </div>
            </div>
        </div>
    </div>

    {{-- 3. KURIKULUM SECTION --}}
    <div class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold mb-1">Kurikulum Pembelajaran</h3>
                <p class="text-muted">Pendekatan belajar yang menyenangkan dan terstruktur.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 border-0 shadow-sm rounded-4 bg-white h-100">
                        <i class="bi bi-palette fs-2 mb-3 d-block text-success"></i>
                        <h5 class="fw-bold text-dark">Kreativitas & Seni</h5>
                        <p class="small text-muted">Mengembangkan imajinasi anak melalui melukis, kerajinan tangan, dan musik.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border-0 shadow-sm rounded-4 bg-white h-100">
                        <i class="bi bi-gear fs-2 mb-3 d-block text-primary"></i>
                        <h5 class="fw-bold text-dark">Kognitif & Logika</h5>
                        <p class="small text-muted">Pengenalan angka, huruf, dan pemecahan masalah sederhana melalui permainan edukatif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border-0 shadow-sm rounded-4 bg-white h-100">
                        <i class="bi bi-people fs-2 mb-3 d-block text-warning"></i>
                        <h5 class="fw-bold text-dark">Sosial & Emosional</h5>
                        <p class="small text-muted">Membangun kemandirian, kerjasama tim, dan empati antar sesama teman.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. FORMULIR SECTION (Target Anchor) --}}
    <div class="py-5 bg-white" id="daftar-form">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-4">Mari Bergabung!</h3>
                    <p class="text-dark fw-medium mb-4">
                        Pendaftaran tahun ajaran baru telah dibuka. Berikan fondasi terbaik untuk masa depan buah hati Anda.
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Fasilitas Ruang Belajar Nyaman</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Tenaga Pendidik Berpengalaman</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Kurikulum Berbasis Kasih</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="card p-4 shadow border-0 rounded-4">
                        <h4 class="fw-bold mb-4 text-center">Formulir Minat</h4>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small fw-bold mb-1">Nama Orang Tua</label>
                                <input type="text" name="name" class="form-control" placeholder="Contoh: Bpk. Budi" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold mb-1">Nomor WhatsApp</label>
                                <input type="text" name="phone" class="form-control" placeholder="0812xxxx" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold mb-1">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold mb-1">Nama Calon Siswa</label>
                                <input type="text" name="child_name" class="form-control" placeholder="Nama Lengkap Anak">
                            </div>
                            <button type="submit" class="btn btn-dark w-100 py-2 mt-3 fw-bold">Kirim Informasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@else
    {{-- ========================================== --}}
    {{-- TAMPILAN PROGRAM IBADAH (Gaya Spiritual)   --}}
    {{-- ========================================== --}}
    <div class="position-relative py-5 text-center text-white" 
         style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('storage/' . $program->image) }}'); 
                background-size: cover; background-position: center; min-height: 500px; display: flex; align-items: center;">
        <div class="container">
            <span class="badge bg-primary px-3 py-2 mb-3 shadow">Kegiatan Rohani</span>
            <h1 class="display-2 fw-bold mb-3" style="letter-spacing: -2px;">{{ $program->title }}</h1>
            <p class="fs-4 opacity-75 fw-light italic">"Sebab di mana dua atau tiga orang berkumpul dalam Nama-Ku, di situ Aku ada di tengah-tengah mereka."</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center g-4 text-center">
            <div class="col-md-4">
                <div class="p-4 border-0 rounded-4 bg-white shadow-sm h-100 border-top border-primary border-4">
                    <i class="bi bi-clock-history fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Waktu Ibadah</h5>
                    <p class="text-secondary mb-0">Setiap {{ $program->schedule_date ? $program->schedule_date->format('l') : 'Minggu' }}</p>
                    <p class="fw-bold text-dark fs-5">{{ $program->schedule_time ? $program->schedule_time->format('H:i') : '09:00' }} WIB</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border-0 rounded-4 bg-white shadow-sm h-100 border-top border-danger border-4">
                    <i class="bi bi-geo-alt-fill fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold">Lokasi</h5>
                    <p class="text-secondary mb-0">{{ $program->location ?? 'Aula Utama Yayasan' }}</p>
                </div>
            </div>

            <div class="col-lg-10 mt-5 pt-5 border-top">
                <h3 class="fw-bold text-dark mb-4">Mengenai Pelayanan Kami</h3>
                <div class="text-secondary lh-lg fs-5 text-start">
                    {{ $program->description }}
                </div>
                <div class="mt-5">
                    <a href="{{ route('contact.index') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-pill shadow">
                        <i class="bi bi-whatsapp me-2"></i>Tanya Tentang Ibadah Ini
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- 5. GALERI PROGRAM (DINAMIS & RELEVAN) --}}
<div class="py-5 bg-light border-top">
    <div class="container text-center">
        <h3 class="fw-bold mb-1">Galeri Kegiatan</h3>
        <p class="text-muted mb-5">Dokumentasi momen kebersamaan dalam program {{ $program->title }}.</p>
        
        <div class="row g-4 justify-content-center">
            {{-- Menggunakan @forelse untuk menangani jika data galeri kosong --}}
            @forelse($galleries as $gallery)
                <div class="col-md-3 col-6">
                    <div class="gallery-item overflow-hidden rounded-4 shadow-sm position-relative" 
                         style="cursor: pointer; height: 250px;"
                         data-bs-toggle="modal" 
                         data-bs-target="#galleryPreviewModal"
                         data-image="{{ asset('storage/' . $gallery->image) }}"
                         data-title="{{ $gallery->title }}"
                         data-desc="{{ $gallery->description }}">
                        
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             class="w-100 h-100 object-fit-cover img-hover-zoom" 
                             alt="{{ $gallery->title }}">
                        
                        {{-- Overlay saat kursor diarahkan --}}
                        <div class="gallery-overlay d-flex align-items-center justify-content-center">
                            <i class="bi bi-zoom-in text-white fs-2"></i>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-muted">
                    <i class="bi bi-images fs-1 d-block mb-3 opacity-25"></i>
                    <p>Belum ada dokumentasi untuk program ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- MODAL PREVIEW GAMBAR --}}
<div class="modal fade" id="galleryPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
            <div class="modal-body p-0 bg-dark text-center">
                <img src="" id="modalImg" class="img-fluid" style="max-height: 80vh;">
                <div class="p-4 bg-white text-start">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0" id="modalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <p class="text-muted mb-0 small" id="modalDesc"></p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT UNTUK MODAL --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const previewModal = document.getElementById('galleryPreviewModal');
    if (previewModal) {
        previewModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            // Update konten modal berdasarkan data attribute
            document.getElementById('modalImg').src = button.getAttribute('data-image');
            document.getElementById('modalTitle').innerText = button.getAttribute('data-title');
            document.getElementById('modalDesc').innerText = button.getAttribute('data-desc');
        });
    }
});
</script>

<style>
    /* Haluskan gerakan scroll */
    html { scroll-behavior: smooth; }
    body { background-color: #ffffff !important; font-family: 'Inter', sans-serif; }
    #daftar-form { scroll-margin-top: 80px; }

    /* Desain Galeri Baru */
    .object-fit-cover { object-fit: cover; }
    
    .img-hover-zoom {
        transition: transform 0.5s ease;
    }

    .gallery-item:hover .img-hover-zoom {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.4);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    /* Penyesuaian Komponen Lain */
    .form-control { border-radius: 8px; padding: 12px; border: 1px solid #dee2e6; background-color: #f8f9fa; }
    .btn-dark { border-radius: 8px; background-color: #000; transition: all 0.3s ease; }
    .btn-dark:hover { background-color: #333; transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
    .rounded-4 { border-radius: 1.2rem !important; }
</style>
@endsection