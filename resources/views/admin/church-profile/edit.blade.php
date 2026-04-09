@extends('layouts.admin.app')

@section('title', 'Profil Gereja')
@section('header', 'Profil Gereja')

@section('content')
<div class="container-fluid py-4">
    <form action="{{ route('admin.church-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-info-circle me-2"></i>Informasi Utama</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Yayasan/Gereja</label>
                                <input type="text" name="church_name" class="form-control" value="{{ old('church_name', $profile->church_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Pendeta</label>
                                <input type="text" name="pastor_name" class="form-control" value="{{ old('pastor_name', $profile->pastor_name) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Visi</label>
                            <textarea name="vision" class="form-control" rows="2" required>{{ old('vision', $profile->vision) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Misi</label>
                            <textarea name="mission" class="form-control" rows="4" required>{{ old('mission', $profile->mission) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sejarah</label>
                            <textarea name="history" class="form-control" rows="6" required>{{ old('history', $profile->history) }}</textarea>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="address" class="form-control" rows="3" required>{{ old('address', $profile->address) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-megaphone me-2"></i>Kontak</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email) }}" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone) }}" required>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-image me-2"></i>Media & Foto</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Logo Yayasan</label>
                            <input type="file" name="logo" class="form-control mb-2">
                            @if($profile->logo)
                                <img src="{{ asset('storage/' . $profile->logo) }}" class="img-thumbnail rounded shadow-sm" width="80">
                            @endif
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Foto Gedung/Gereja</label>
                            <input type="file" name="church_image" class="form-control mb-2">
                            @if($profile->church_image)
                                <img src="{{ asset('storage/' . $profile->church_image) }}" class="img-thumbnail rounded shadow-sm" width="120">
                            @endif
                            <div class="form-text small text-muted">Muncul di hero section halaman About.</div>
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Foto Profil Pendeta</label>
                            <input type="file" name="pastor_image" class="form-control mb-2">
                            @if($profile->pastor_image)
                                <img src="{{ asset('storage/' . $profile->pastor_image) }}" class="img-thumbnail rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                            <div class="form-text small text-muted">Gunakan rasio 1:1 (Square).</div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm mt-2">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .form-label { font-size: 0.9rem; color: #444; }
    .card-header { border-bottom: 1px solid #f8f9fa !important; }
    .img-thumbnail { border: 2px solid #f8f9fa; }
</style>
@endsection