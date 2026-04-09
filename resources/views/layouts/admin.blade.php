<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #2c3e50;
            --sidebar-width: 250px;
        }

        body { background: #f8f9fa; margin: 0; padding: 0; }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--primary-color);
            color: white;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu a, 
        .sidebar-menu .nav-link-logout {
            display: block;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
            background: none;
        }

        .sidebar-menu li.active a,
        .sidebar-menu a:hover,
        .sidebar-menu .nav-link-logout:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .text-danger-custom {
            color: #ff7675 !important;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4 text-center border-bottom border-secondary mb-2">
        <h5 class="m-0 fw-bold">Mutiara Kasih Admin</h5>
    </div>

    <ul class="sidebar-menu">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <i class="bi bi-people-fill me-2"></i> Manajemen User
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.jemaats.index') }}">
                <i class="bi bi-people-fill me-2"></i> Manajemen Data Jemaat
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
            <a href="{{ route('admin.programs.index') }}">
                <i class="bi bi-calendar-event me-2"></i> Program
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <a href="{{ route('admin.contacts.index') }}">
                <i class="bi bi-envelope me-2"></i> Kontak
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.church-profile.*') ? 'active' : '' }}">
            <a href="{{ route('admin.church-profile.edit') }}">
                <i class="bi bi-building me-2"></i> Profil Gereja
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.galleries*') ? 'active' : '' }}">
            <a href="{{ route('admin.galleries.edit') }}">
                <i class="bi bi-building me-2"></i> Galeri Kegiatan
            </a>
        </li>
    </ul> 
</div>

<div class="main-content">
    <div class="container-fluid">
        <h4 class="mb-4">@yield('page-title')</h4>
        @yield('content')
    </div>
</div>

<script>
    function confirmAdminLogout() {
        Swal.fire({
            title: 'Keluar dari Panel Admin?',
            text: "Pastikan semua pekerjaan Anda telah disimpan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form-admin').submit();
            }
        })
    }
</script>

</body>
</html>