@extends('layouts.admin.app')

@section('title', 'Detail Pesan')
@section('header', 'Detail Pesan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Pesan dari {{ $contact->name }}</h6>
                @if($contact->status === 'unread')
                    <span class="badge bg-warning text-dark">Belum Dibaca</span>
                @else
                    <span class="badge bg-success">Sudah Dibaca</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase">Nama Lengkap</label>
                        <p class="fw-semibold mb-0">{{ $contact->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase">Email</label>
                        <p class="fw-semibold mb-0">
                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                        </p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small text-uppercase">No. Telepon</label>
                    <p class="fw-semibold">{{ $contact->phone ?? '-' }}</p>
                </div>

                <div class="mb-4">
                    <label class="text-muted small text-uppercase">Isi Pesan</label>
                    <div class="p-3 bg-light rounded">
                        {{ $contact->message }}
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-muted small text-uppercase">Diterima Pada</label>
                    <p class="mb-0">{{ $contact->created_at->format('d F Y, H:i') }} WIB</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <div class="d-flex gap-2">
                        <a href="mailto:{{ $contact->email }}?subject=Balasan: Pesan ke Gereja" class="btn btn-primary">
                            <i class="bi bi-reply me-1"></i> Balas via Email
                        </a>
                        
                        <a href="https://wa.me/{{ $contact->phone }}?text=Balasan:%20Pesan%20ke%20Gereja" class="btn btn-success" target="_blank">
                           <i class="bi bi-whatsapp me-1"></i> Balas via Whatsapp
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
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
@endsection