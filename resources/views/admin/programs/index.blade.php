@extends('layouts.admin.app')

@section('title', 'Kelola Program')
@section('header', 'Daftar Program Yayasan')

@section('content')

<style>
    .program-card { border-radius: 16px; transition: all 0.25s ease; overflow: hidden; border: none; }
    .program-card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.1); }
    .category-badge { position: absolute; top: 15px; left: 15px; z-index: 10; font-size: 0.75rem; text-transform: uppercase; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Semua Program</h4>
        <p class="text-muted mb-0">Kelola konten pendidikan dan kegiatan ibadah</p>
    </div>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary px-4 shadow-sm">
        <i class="bi bi-plus-lg me-2"></i> Tambah Program
    </a>
</div>

<div class="row g-4">
    @forelse($programs as $program)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm program-card">
            <span class="badge category-badge {{ $program->category == 'pendidikan' ? 'bg-primary' : 'bg-success' }}">
                {{ $program->category }}
            </span>

            <div class="position-relative bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                @if($program->image)
                    <img src="{{ asset('storage/' . $program->image) }}" class="w-100 h-100" style="object-fit: cover;">
                @else
                    <i class="bi bi-image text-muted fs-1"></i>
                @endif
            </div>

            <div class="card-body">
                <h5 class="fw-bold mb-2">{{ $program->title }}</h5>
                <p class="text-muted small mb-3">{{ Str::limit($program->description, 70) }}</p>
                
                <div class="p-3 bg-light rounded-3 mb-3 small">
                    <div class="mb-1"><i class="bi bi-calendar3 me-2 text-primary"></i> {{ $program->date ? \Carbon\Carbon::parse($program->date)->translatedFormat('d M Y') : '-' }}</div>
                    <div><i class="bi bi-geo-alt me-2 text-primary"></i> {{ $program->location ?? '-' }}</div>
                </div>
            </div>

            {{-- FOOTER AKSI --}}
            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3 px-3">
                <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-sm btn-outline-primary flex-grow-1 py-2">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>

                {{-- FORM DELETE --}}
                <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="form-delete flex-grow-1">
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
    <div class="col-12 text-center py-5"><p class="text-muted">Data kosong</p></div>
    @endforelse
</div>

{{-- SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gunakan selector class yang tepat sesuai tombol di atas
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                // Cari form terdekat dari tombol yang diklik
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data program ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f', // Warna Merah (Sama dengan Jemaat)
                    cancelButtonColor: '#3490dc', // Warna Biru (Sama dengan Jemaat)
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
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