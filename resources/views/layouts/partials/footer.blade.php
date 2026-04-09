<footer class="py-5 text-white mt-auto" style="background-color: #121213 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/Logo.Yayasan.png') }}" 
                         width="45" 
                         height="45" 
                         class="me-2" 
                         style="object-fit: contain; border-radius: 50%; background: white; padding: 2px;">
                    <h5 class="mb-0 fw-bold">Yayasan Mutiara Kasih Karunia</h5>
                </div>
                <p class="text-white-50 small">
                    Melayani Tuhan dengan sepenuh hati untuk membangun jemaat yang beriman dan bertumbuh dalam Kristus.
                </p>
                <div class="social-links mt-3">
                    <a href="#" class="text-white-50 me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white-50 me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-white fw-bold mb-3">Tautan Cepat</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none small">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none small">Tentang</a></li>
                    <li class="mb-2"><a href="{{ route('programs.index') }}" class="text-white-50 text-decoration-none small">Program</a></li>
                    <li class="mb-2"><a href="{{ route('contact.index') }}" class="text-white-50 text-decoration-none small">Kontak</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-white fw-bold mb-3">Kategori</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none small">Ibadah</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none small">Pendidikan</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="text-white fw-bold mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-geo-alt text-danger me-2 mt-1"></i>
                        <span>Jl. BTN Bukit Lateri Indah Blok c5 No10<br>Desa Lateri Kecamatan Baguala Kota Ambon</span>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone text-danger me-2"></i>
                        <span>081247253105</span>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope text-danger me-2"></i>
                        <span>kartini.siahaya@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="border-secondary my-4 opacity-25">
        
        <div class="text-center text-white-50">
            <small>&copy; {{ date('Y') }} Yayasan Mutiara Kasih Karunia. All rights reserved.</small>
        </div>
    </div>
</footer>

<style>
    /* Agar link di footer berubah warna saat di-hover */
    footer a:hover {
        color: #ffffff !important;
        transition: 0.3s;
    }
    .social-links a:hover {
        color: #ff4757 !important;
    }
</style>