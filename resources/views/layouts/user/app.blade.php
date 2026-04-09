<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Gereja')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #1d1e1f;
            color: #fff;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        /* PERBAIKAN: Selector dibuat lebih spesifik */
        .sidebar .sidebar-brand {
            display: flex !important;
            align-items: center !important;
            padding: 20px !important;
            border-bottom: 1px solid #34495e !important;
            height: 80px; /* Mengunci tinggi area header */
        }

        /* PERBAIKAN: Memaksa gambar tetap kecil apapun ukurannya */
        .sidebar .sidebar-brand img {
            width: 40px !important;
            height: 40px !important;
            max-width: 40px !important;
            max-height: 40px !important;
            object-fit: contain !important;  
            margin-right: 12px !important;
            flex-shrink: 0 !important;
        }

        .sidebar .sidebar-brand h4 {
            margin: 0 !important;
            font-size: 1.2rem !important;
            font-weight: bold !important;
            color: #fff !important;
            white-space: nowrap;
        }

        .sidebar-menu {
            flex-grow: 1; 
            padding-top: 15px;
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ddd;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #34495e;
            color: #fff;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #34495e;
            background: #080809;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-modern {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(22, 21, 21, 0.05);
        }
    </style>
</head>

<body>
<div class="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('images/Logo.Yayasan.png') }}" alt="Logo">
        <h4>User</h4>
    </div>

    <div class="sidebar-menu">
        <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('user.programs.index') }}" class="{{ request()->routeIs('user.programs.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event me-2"></i> Program
        </a>

        <a href="{{ route('user.contacts.index') }}" class="{{ request()->routeIs('user.contacts.*') ? 'active' : '' }}">
            <i class="bi bi-envelope me-2"></i> Kontak
        </a>

        <a href="{{ route('user.church-profile.edit') }}" class="{{ request()->routeIs('user.church-profile.*') ? 'active' : '' }}">
            <i class="bi bi-building me-2"></i> Profil
        </a>
    </div>

   <div class="sidebar-footer">
        <form id="logout-form-user" method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
        <button type="button" onclick="confirmLogout()" class="btn btn-danger w-100">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <h5 class="mb-0">@yield('header', 'Dashboard')</h5>
        <span>👤 {{ Auth::user()->name }}</span>
    </div>

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: "Sesi User Anda akan berakhir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengirim form secara manual jika tombol 'Ya' diklik
                document.getElementById('logout-form-user').submit();
            }
        })
    }
</script>

</body>
</html>