@extends('layouts.user.app')

@section('title', 'Kelola Program')
@section('header', 'Daftar Program Gereja')

@section('content')

<style>
    .program-card {
        border-radius: 16px;
        transition: all 0.25s ease;
        overflow: hidden;
    }
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.1);
    }
    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 10;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Semua Program</h4>
        <p class="text-muted mb-0">Kelola jadwal dan kegiatan gereja</p>
    </div>
    <a href="{{ route('user.programs.create') }}" class="btn btn-primary px-4 shadow-sm">
        <i class="bi bi-plus-lg me-2"></i> Tambah Program
    </a>
</div>

<div class="row g-4">
    @forelse($programs as $program)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-0 program-card">
            
            {{-- Badge Kategori --}}
            <span class="badge category-badge {{ $program->category == 'pendidikan' ? 'bg-primary' : 'bg-success' }}">
                {{ $program->category }}
            </span>

            {{-- Gambar --}}
            <div class="position-relative">
                @if($program->image)
                    <img src="{{ asset('storage/' . $program->image) }}" 
                         class="card-img-top" 
                         style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="bi bi-image text-muted fs-1"></i>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0 text-truncate" style="max-width: 80%;">{{ $program->title }}</h5>
                    @if($program->category == 'pendidikan')
                        <i class="bi bi-journal-bookmark-fill text-primary" data-bs-toggle="tooltip" title="Memiliki Data Kurikulum"></i>
                    @endif
                </div>

                <p class="text-muted small mb-3 text-secondary">
                    {{ Str::limit($program->description, 70) }}
                </p>

                {{-- Detail Info --}}
                <div class="p-3 bg-light rounded-3 mb-3">
                    <div class="mb-2 small text-dark d-flex align-items-center">
                        <i class="bi bi-calendar3 me-2 text-primary"></i> 
                        {{ $program->schedule_date ? \Carbon\Carbon::parse($program->schedule_date)->translatedFormat('d M Y') : 'Jadwal belum diatur' }}
                    </div>
                    <div class="mb-2 small text-dark d-flex align-items-center">
                        <i class="bi bi-clock me-2 text-primary"></i> 
                        {{ $program->schedule_time ?? '--:--' }} WIB
                    </div>
                    <div class="small text-dark d-flex align-items-center">
                        <i class="bi bi-geo-alt me-2 text-primary"></i> 
                        {{ $program->location ?? 'Lokasi belum diatur' }}
                    </div>
                </div>

                {{-- Status --}}
                @php
                    $isUpcoming = $program->schedule_date >= now();
                @endphp
                <div class="d-flex align-items-center">
                    <span class="badge {{ $isUpcoming ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} px-3">
                        <i class="bi {{ $isUpcoming ? 'bi-clock-history' : 'bi-check-circle' }} me-1"></i>
                        {{ $isUpcoming ? 'Akan Datang' : 'Selesai' }}
                    </span>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3 px-3">
                <a href="{{ route('user.programs.edit', $program) }}" 
                   class="btn btn-sm btn-outline-primary flex-grow-1 py-2">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>

                <form action="{{ route('user.programs.destroy', $program) }}" 
                      method="POST" class="form-delete flex-grow-1">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-outline-danger w-100 py-2 btn-delete">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="py-5">
            <i class="bi bi-folder-x fs-1 text-muted mb-3 d-block"></i>
            <h5 class="text-muted">Data program masih kosong</h5>
            <a href="{{ route('user.programs.create') }}" class="btn btn-primary mt-3">Mulai Buat Program</a>
        </div>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($programs->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $programs->links('pagination::bootstrap-5') }}
</div>
@endif

{{-- Script SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gunakan try-catch agar error bootstrap tidak mematikan fungsi hapus
        try {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        } catch (error) {
            console.log("Bootstrap Tooltip skip: " + error);
        }

        // FUNGSI HAPUS (Ini harus tetap jalan)
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // Mencegah aksi default
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Hapus Program?',
                    text: "Data akan dihapus permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Mengirim perintah ke Controller
                    }
                });
            });
        });
    });
</script>

@endsection