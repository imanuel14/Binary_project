@extends('layouts.user.app')

@section('title', 'Detail Pesan')
@section('header', 'Detail Pesan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Pesan dari {{ $contact->name }}</h6>
                @if($contact->status === 'unread')
                    <span class="badge bg-warning text-dark">Belum Dibaca</span>
                @else
                    <span class="badge bg-success">Sudah Dibaca</span>
                @endif
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold">Nama Lengkap</label>
                        <p class="fw-semibold mb-0">{{ $contact->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold">Email</label>
                        <p class="fw-semibold mb-0">
                            <a href="mailto:{{ $contact->email }}" class="text-decoration-none">{{ $contact->email }}</a>
                        </p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small text-uppercase fw-bold">No. Telepon</label>
                    <p class="fw-semibold">{{ $contact->phone ?? '-' }}</p>
                </div>

                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-bold">Isi Pesan</label>
                    <div class="p-3 bg-light rounded border-start border-4 border-primary">
                        {{ $contact->message }}
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-bold">Diterima Pada</label>
                    <p class="mb-0 text-muted"><i class="bi bi-clock me-1"></i> {{ $contact->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>

                <hr class="opacity-25">

                <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                    <a href="{{ route('user.contacts.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    
                    <div class="d-flex flex-wrap gap-2">
                        <a href="mailto:{{ $contact->email }}?subject=Balasan: Pesan ke Gereja" class="btn btn-primary">
                            <i class="bi bi-reply me-1"></i> Balas via Email
                        </a>
                        
                        {{-- Menambahkan tombol WhatsApp agar sama dengan admin --}}
                        @if($contact->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}?text=Halo%20{{ urlencode($contact->name) }},%20kami%20ingin%20membalas%20pesan%20Anda..." class="btn btn-success" target="_blank">
                           <i class="bi bi-whatsapp me-1"></i> Balas via Whatsapp
                        </a>
                        @endif

                        <form action="{{ route('user.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card { border-radius: 12px; }
    .card-header { border-top-left-radius: 12px !important; border-top-right-radius: 12px !important; border-bottom: 1px solid #f0f0f0 !important; }
    .fw-semibold { color: #333; }
</style>
@endsection