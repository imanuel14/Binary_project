@extends('layouts.admin.app')

@section('title', 'Daftar Pengguna') {{-- Menambahkan Title --}}

@section('content')
<style>
    /* Mengadopsi style dari Jemaats untuk tombol aksi */
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

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mt-4">Daftar Pengguna</h2>
            <p class="text-muted">Kelola akses akun administrator</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah User
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th width="220px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    {{-- Tombol Edit: Menggunakan class dari Jemaat --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    
                                    {{-- Tombol Hapus: Menggunakan class btn-delete dan form-delete agar terbaca script --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                          method="POST" 
                                          class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger px-3 btn-delete">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT KONFIRMASI (Sama dengan Jemaat) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Akun pengguna ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#3490dc',
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