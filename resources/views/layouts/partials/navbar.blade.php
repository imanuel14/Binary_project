<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center me-auto" href="{{ route('home') }}">
            <img src="{{ asset('images/Logo.Yayasan.png') }}" 
                 alt="Logo" 
                 width="40" 
                 height="40" 
                 class="d-inline-block align-top me-2">
            <span class="fw-semibold">Yayasan Mutiara Kasih Karunia</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarYayasan" aria-controls="navbarYayasan" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarYayasan">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                
                {{-- Dropdown Program --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="programDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Program
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item" href="{{ route('programs.index') }}">Semua Program</a></li>
                        <li><a class="dropdown-item" href="{{ route('programs.ibadah') }}">Program Ibadah</a></li>
                        <li><a class="dropdown-item" href="{{ route('programs.pendidikan') }}">Program Pendidikan</a></li>
                    </ul>
                </li>

                {{-- Dropdown Tentang & Galeri --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item" href="{{ route('about') }}">Profil Yayasan</a></li>
                        <li><a class="dropdown-item" href="{{ route('gallery.index') }}">Galeri Kegiatan</a></li>
                    </ul>
                </li>
                
                <li class="nav-item me-lg-3"> 
                    <a class="nav-link" href="{{ route('contact.index') }}">Kontak</a>
                </li>

                @guest('admin')
                <li class="nav-item border-start d-none d-lg-block ps-3"></li> 
                <li class="nav-item">
                    <a class="nav-link text-warning fw-bold" href="{{ route('login') }}">
                        <i class="bi bi-lock"></i> Login
                    </a>
                </li>
                @endguest

                @auth('admin')
                <li class="nav-item border-start d-none d-lg-block ps-3"></li>
                <li class="nav-item">
                    {{-- Diubah dari 'Login' menjadi 'Dashboard' agar lebih akurat --}}
                    <a class="nav-link text-success fw-bold" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>