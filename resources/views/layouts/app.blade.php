<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Gereja')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
        /* Menggunakan latar belakang putih bersih agar teks tajam */
        background-color: #ffffff;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
    }

    .main-wrapper {
        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Membuat Watermark Logo di Tengah Halaman */
    .main-wrapper::before {
        content: "";
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px; /* Ukuran logo di tengah */
        height: 600px;
        /* Menggunakan gambar yayasan sebagai watermark */
        background-image: url('{{ asset("images/Logo.Yayasan.png") }}');
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.05; /* SANGAT PENTING: Nilai 0.05 membuat logo samar (watermark) */
        z-index: -1; /* Berada di belakang konten */
    }

    /* Memastikan footer tetap di bawah jika konten sedikit */
    .container {
        flex: 1;
    }
</style>
</head>

<body>

<div class="main-wrapper">
    
    @include('layouts.partials.navbar')

    <div class="container py-4">
        @yield('content')
    </div>

    @include('layouts.partials.footer')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>