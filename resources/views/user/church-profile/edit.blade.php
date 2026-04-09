@extends('layouts.user.app')

@section('title', 'Profil Gereja')
@section('header', 'Profil Gereja')

@section('content')
<div class="container-fluid py-4">
    {{-- Route tetap menggunakan route admin/user sesuai kebutuhan sistem Anda --}}
    <form action="{{ route('admin.church-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            {{-- Bagian Kiri: Informasi Utama --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4 rounded-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-info-circle me-2"></i>Informasi Utama</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Yayasan/Gereja</label>
                                <input type="text" name="church_name" class="form-control" value="{{ old('church_name', $profile->church_name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Pendeta Senior</label>
                                <input type="text" name="pastor_name" class="form-control" value="{{ old('pastor_name', $profile->pastor_name ?? '') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Visi</label>
                            <textarea name="vision" class="form-control" rows="2" required>{{ old('vision', $profile->vision ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Misi</label>
                            <small class="text-muted d-block mb-2">Gunakan enter untuk baris baru agar terlihat rapi.</small>
                            <textarea name="mission" class="form-control" rows="4" required>{{ old('mission', $profile->mission ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Sejarah Singkat</label>
                            <textarea name="history" class="form-control" rows="6" required>{{ old('history', $profile->history ?? '') }}</textarea>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea name="address" class="form-control" rows="3" required>{{ old('address', $profile->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Kontak & Media --}}
            <div class="col-lg-4">
                {{-- Card Kontak --}}
                <div class="card shadow-sm border-0 mb-4 rounded-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-megaphone me-2"></i>Kontak</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email ?? '') }}" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone ?? '') }}" required>
                        </div>
                    </div>
                </div>

                {{-- Card Media --}}
                <div class="card shadow-sm border-0 mb-4 rounded-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-image me-2"></i>Media & Foto</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Logo (PNG Transparan)</label>
                            <input type="file" name="logo" class="form-control mb-2" accept="image/*">
                            @if($profile && $profile->logo)
                                <img src="{{ asset('storage/' . $profile->logo) }}" class="img-thumbnail rounded shadow-sm" width="80">
                                <div class="mt-1 small text-muted">Logo saat ini terpasang.</div>
                            @endif
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Gedung/Gereja</label>
                            <input type="file" name="church_image" class="form-control mb-2" accept="image/*">
                            @if($profile && $profile->church_image)
                                <img src="{{ asset('storage/' . $profile->church_image) }}" class="img-thumbnail rounded shadow-sm" width="120">
                            @endif
                            <div class="form-text small text-muted">Muncul di halaman profil utama.</div>
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Profil Pendeta</label>
                            <input type="file" name="pastor_image" class="form-control mb-2" accept="image/*">
                            @if($profile && $profile->pastor_image)
                                <img src="{{ asset('storage/' . $profile->pastor_image) }}" class="img-thumbnail rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                            <div class="form-text small text-muted">Gunakan rasio 1:1 (Square).</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm mt-2 fw-bold">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                            <button type="reset" class="btn btn-light">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .form-label { font-size: 0.9rem; }
    .img-thumbnail { border: 2px solid #f8f9fa; }
    .card-header { border-bottom: 1px solid #f8f9fa !important; }
</style>
@endsection