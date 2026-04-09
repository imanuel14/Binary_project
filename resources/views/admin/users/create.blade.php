@extends('layouts.admin.app')

@section('content')
<style>
    /* Styling Kustom untuk menyamakan dengan Gambar */
    .form-container {
        max-width: 700px;
        margin: 0 auto;
    }
    .form-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: none;
    }
    .input-group-text {
        background-color: transparent;
        border-right: none;
        color: #94a3b8;
    }
    .form-control, .form-select {
        border-left: none;
        background-color: #f8fafc;
        border-color: #e2e8f0;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff;
        box-shadow: none;
        border-color: #334155;
    }
    .label-custom {
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    .btn-register {
        background-color: #0f172a;
        color: white;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-register:hover {
        background-color: #1e293b;
        color: white;
    }
    .header-icon {
        background-color: #0f172a;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
</style>

<div class="container py-5">
    <div class="form-container">
        <div class="text-center mb-4">
            <div class="header-icon">
                <i class="bi bi-person-plus-fill fs-4"></i>
            </div>
            <h3 class="fw-bold text-dark">Tambah User Baru</h3>
            <p class="text-muted small">Lengkapi informasi di bawah untuk mendaftarkan akun baru ke sistem.</p>
        </div>

        <div class="card form-card">
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="label-custom">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="label-custom">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-custom">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="........" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="label-custom">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-arrow-repeat"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="........" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label-custom">Role / Peran</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <select name="role" class="form-select">
                                <option value="" disabled selected>Pilih Role...</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-register w-100 py-2">Daftarkan User</button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100 py-2 border-light-subtle">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection