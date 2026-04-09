@extends('layouts.admin.app')

@section('title', 'Data Jemaat')

@section('content')
<style>
    /* Style tambahan untuk tombol aksi agar sesuai gambar */
    .btn-outline-primary, .btn-outline-danger, .btn-outline-info {
        border-radius: 8px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .btn-outline-primary:hover { background-color: #4e73df; color: white; }
    .btn-outline-danger:hover { background-color: #e74a3b; color: white; }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Data Jemaat</h1>
            <p class="text-muted">Kelola data seluruh jemaat gereja</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.jemaats.export.excel') }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('admin.jemaats.export.pdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('admin.jemaats.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Jemaat
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Jemaat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] ?? $jemaats->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Jemaat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nomor Induk</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th width="220px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jemaats as $index => $jemaat)
                        <tr>
                            <td>{{ $jemaats->firstItem() + $index }}</td>
                            <td class="text-center">
                                @if($jemaat->foto)
                                    <img src="{{ asset('storage/' . $jemaat->foto) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                @endif
                            </td>
                            <td><code>{{ $jemaat->nomor_induk }}</code></td>
                            <td><strong>{{ $jemaat->nama_lengkap }}</strong></td>
                            <td>
                                <span class="badge badge-{{ $jemaat->status_jemaat == 'aktif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($jemaat->status_jemaat) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    {{-- Tombol View --}}
                                    <a href="{{ route('admin.jemaats.show', $jemaat) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Tombol Edit (Style Gambar) --}}
                                    <a href="{{ route('admin.jemaats.edit', $jemaat) }}" class="btn btn-sm btn-outline-primary px-3">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    
                                    {{-- Tombol Hapus (Style Gambar + SweetAlert) --}}
                                    <form action="{{ route('admin.jemaats.destroy', $jemaat) }}" method="POST" class="form-delete d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger px-3 btn-delete">
                                          <i class="bi bi-trash me-1"></i> Hapus
                                         </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">Data jemaat tidak ditemukan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $jemaats->links() }}
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT POP-UP KONFIRMASI --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data jemaat ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f', // Warna Merah (Ya, Hapus)
                    cancelButtonColor: '#3490dc', // Warna Biru (Batal)
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