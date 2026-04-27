@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Judul Halaman Sesuai Referensi Gambar Kanan --}}
    <div class="mb-5" data-aos="fade-down">
        <h1 class="fw-bold display-4 text-dark mb-3">Hubungi kami.</h1>
        <p class="text-secondary lead w-75">
            Tim kami siap membantu Anda. Hubungi kami untuk dukungan, pertanyaan seputar program yayasan, atau sekadar menyapa.
        </p>
    </div>

    <div class="row g-5"> {{-- Menambah gap antarkolom --}}
        
        <div class="col-lg-6" data-aos="fade-right">

            {{-- Form Kontak --}}
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
    @csrf
    {{-- Menentukan kategori agar masuk ke tab Ibadah di Admin --}}
    <input type="hidden" name="category" value="ibadah">

    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="form-label fw-bold small text-muted">NAMA LENGKAP</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
        </div>
        <div class="col-md-6 mb-4">
            <label class="form-label fw-bold small text-muted">EMAIL</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold small text-muted">NO. TELEPON / WHATSAPP</label>
            <input type="tel" name="phone" class="form-control" placeholder="Contoh: 08123456789" required>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label fw-bold small text-muted">PESAN</label>
        <textarea name="message" class="form-control" rows="4" placeholder="Tuliskan pesan Anda..." required>{{ old('message') }}</textarea>
    </div>

    <button type="submit" class="btn btn-dark btn-lg w-100 py-3 fw-bold">
        <i class="bi bi-send-fill me-2"></i>Kirim Pesan
    </button>

    @if(session('success'))
        <div class="alert alert-success mt-3 small shadow-sm border-0">{{ session('success') }}</div>
    @endif
</form>
                </div>
            </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left">
            <h5 class="fw-bold mb-4"><i class="bi bi-map-fill me-2"></i>Lokasi Kami</h5>
            <div class="rounded-4 overflow-hidden shadow-sm border" style="height: 550px;">
                {{-- Ganti URL src di bawah ini dengan link embed Google Maps yayasan Anda --}}
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4339.489534346981!2d128.24379847535707!3d-3.6435312427471103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6cec0714108d51%3A0x8c8c4a4c2a4c7c93!2sBTN%20Bukit%20Lateri%20Indah!5e1!3m2!1sid!2sid!4v1775559034521!5m2!1sid!2sid" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    
                </iframe>
            </div>
            {{-- Info Tambahan di Bawah Maps --}}
            <div class="mt-3 p-3 bg-light rounded-4 border">
                <p class="small text-muted mb-0">
                    <strong>Pusat Layanan:</strong> Kunjungi kantor kami pada jam kerja (Senin - Jumat, 08:00 - 17:00 WIB).
                </p>
            </div>
        </div>

    </div>
</div>

<style>
    .form-control {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    .form-control:focus {
        background-color: #fff;
        border-color: #2c3e50;
        box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.1);
    }
    .transition-hover:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
        background-color: #000;
    }
</style>
@endsection