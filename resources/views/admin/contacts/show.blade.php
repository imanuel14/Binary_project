@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Pesan Masuk</h5>
                        <span class="badge bg-light text-dark text-uppercase small">{{ $contact->category }}</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="small text-muted text-uppercase fw-bold">Pengirim</label>
                        <h4 class="text-dark fw-bold">{{ $contact->name }}</h4>
                        <p class="mb-0 text-secondary">{{ $contact->email }} | {{ $contact->phone }}</p>
                    </div>
                    <hr class="my-4 opacity-10">
                    <div class="mb-4">
                        <label class="small text-muted text-uppercase fw-bold">Isi Pesan</label>
                        <div class="p-3 bg-light rounded-3 mt-2" style="white-space: pre-wrap;">{{ $contact->message }}</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small text-muted">Diterima pada: {{ $contact->created_at->format('d F Y, H:i') }}</span>
                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger text-decoration-none small">
                                <i class="bi bi-trash me-1"></i> Hapus Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-light">
                <div class="card-body p-4 text-center">
                    <div class="mb-3 text-dark">
                        <i class="bi bi-whatsapp display-4"></i>
                    </div>
                    <h5 class="fw-bold">Respon Cepat</h5>
                    <p class="small text-muted">Gunakan WhatsApp untuk memberikan tanggapan langsung kepada jemaat.</p>
                    <a href="https://wa.me/{{ $contact->phone }}" target="_blank" class="btn btn-success w-100 rounded-3 fw-bold">
                        Balas via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection