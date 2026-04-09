@extends('layouts.admin.app')

@section('title', 'Manajemen Galeri')
@section('header', 'Galeri Kegiatan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Galeri Kegiatan</h1>
            <p class="text-muted">Kelola foto dokumentasi kegiatan yayasan</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Foto
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm {{ !request('category') ? 'btn-dark' : 'btn-outline-dark' }}">
                    Semua
                </a>
                @foreach(['ibadah', 'pendidikan', 'sosial', 'pemuda'] as $cat)
                <a href="{{ route('admin.galleries.index', ['category' => $cat]) }}" 
                   class="btn btn-sm {{ request('category') == $cat ? 'btn-primary' : 'btn-outline-primary' }}">
                    {{ ucfirst($cat) }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($galleries as $gallery)
        <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow h-100">
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                         class="card-img-top" 
                         style="height: 200px; object-fit: cover;"
                         alt="{{ $gallery->title }}">
                    
                    @if(!$gallery->is_active)
                        <span class="badge badge-secondary position-absolute" style="top: 10px; left: 10px;">Nonaktif</span>
                    @endif
                    
                    <span class="badge badge-{{ match($gallery->category) {
                        'ibadah' => 'primary',
                        'pendidikan' => 'success',
                        'sosial' => 'info',
                        'pemuda' => 'warning',
                        default => 'secondary'
                    } }} position-absolute" style="top: 10px; right: 10px;">
                        {{ ucfirst($gallery->category) }}
                    </span>
                </div>
                <div class="card-body">
                    <h6 class="card-title font-weight-bold">{{ Str::limit($gallery->title, 30) }}</h6>
                    <p class="card-text small text-muted mb-1">
                        <i class="far fa-calendar-alt"></i> 
                        {{ $gallery->event_date?->format('d M Y') ?? 'Tanggal tidak ditentukan' }}
                    </p>
                    <p class="card-text small text-muted">
                        {{ Str::limit($gallery->description, 50) }}
                    </p>
                </div>
                <div class="card-footer bg-white p-2">
                    <div class="row g-2">
                        <div class="col-6">
    {{-- Tombol Edit dengan Ikon Pensil Outline --}}
    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-outline-primary w-100 px-3">
        <i class="bi bi-pencil me-1"></i> Edit
    </a>
</div>
<div class="col-6">
    {{-- Tombol Hapus dengan Ikon Tempat Sampah Outline --}}
    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="form-delete">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-outline-danger w-100 px-3 btn-delete">
            <i class="bi bi-trash me-1"></i> Hapus
        </button>
    </form>
</div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-images fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada foto di galeri</p>
        </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $galleries->links() }}
    </div>
</div>

{{-- Script SweetAlert2 untuk Pop-Up --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data dokumentasi ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f', // Warna merah untuk aksi hapus
                    cancelButtonColor: '#3490dc', // Warna biru untuk batal
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true // Agar tombol Batal di sebelah kiri
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection