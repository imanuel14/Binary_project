@extends('layouts.admin.app') 
@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mt-4">Daftar Pengguna</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah User
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        {{-- <th>Role</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
@foreach($users as $user)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    {{-- <td>{{ $user->role ?? '-' }}</td> --}}
    <td>
    <div class="d-flex gap-2">
                                    {{-- Tombol Edit dengan Border Garis (Outline) --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    
                                    {{-- Tombol Hapus dengan Border Garis & SweetAlert --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                          method="POST" 
                                          class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger px-3 btn-delete">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>
</td>
</tr>
@endforeach
</tbody>
            </table>
        </div>
    </div>
</div>
@endsection