@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Informasi Program & Jadwal Ibadah</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h3>Jadwal Ibadah</h3>
            <ul>
                <li>Ibadah Minggu : 08.00 WIB</li>
                <li>Persekutuan Doa : Rabu, 19.00 WIB</li>
                <li>Pemahaman Alkitab : Jumat, 18.30 WIB</li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>Pengumuman</h3>
            <p>
                Selamat datang di Sistem Informasi Yayasan Mutiara Kasih Karunia.
                Halaman ini digunakan untuk menampilkan informasi program,
                jadwal kegiatan, dan pengumuman terbaru kepada jemaat.
            </p>
        </div>
    </div>
</div>
@endsection