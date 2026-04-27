@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    {{-- Header Section --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold text-dark">Pesan Masuk Jemaat</h2>
            <p class="text-muted small">Total {{ $totalUnread }} pesan belum dibaca perlu tindak lanjut.</p>
        </div>
    </div>

    {{-- Nav Tabs Section --}}
    <ul class="nav nav-pills mb-4 gap-2" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            {{-- Menggunakan nav-link agar kompatibel dengan JS Bootstrap --}}
            <button class="nav-link btn btn-outline-dark rounded-pill active position-relative" 
                    id="pills-pendidikan-tab" 
                    data-bs-toggle="pill" 
                    data-bs-target="#pills-pendidikan" 
                    type="button" 
                    role="tab" 
                    aria-controls="pills-pendidikan" 
                    aria-selected="true">
                Pendidikan 
                @if($unreadPendidikan > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadPendidikan }}
                    </span>
                @endif
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn btn-outline-dark rounded-pill position-relative" 
                    id="pills-ibadah-tab" 
                    data-bs-toggle="pill" 
                    data-bs-target="#pills-ibadah" 
                    type="button" 
                    role="tab" 
                    aria-controls="pills-ibadah" 
                    aria-selected="false">
                Ibadah
                @if($unreadIbadah > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadIbadah }}
                    </span>
                @endif
            </button>
        </li>
    </ul>

    {{-- Tab Content Section --}}
    <div class="tab-content" id="pills-tabContent">
        {{-- Pane Pendidikan --}}
        <div class="tab-pane fade show active" id="pills-pendidikan" role="tabpanel" aria-labelledby="pills-pendidikan-tab">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="table-responsive p-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Pengirim</th>
                                <th>Kontak</th>
                                <th>Pesan Singkat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contactPendidikan as $item)
                            <tr class="{{ $item->status == 'unread' ? 'fw-bold bg-light' : '' }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td class="text-truncate" style="max-width: 200px;">{{ $item->message }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'unread' ? 'bg-danger' : 'bg-secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $item->id) }}" class="btn btn-dark btn-sm rounded-3">Buka</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada pesan pendidikan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pane Ibadah --}}
        <div class="tab-pane fade" id="pills-ibadah" role="tabpanel" aria-labelledby="pills-ibadah-tab">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="table-responsive p-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Pengirim</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contactIbadah as $item)
                            <tr class="{{ $item->status == 'unread' ? 'fw-bold bg-light' : '' }}">
                                <td>{{ $item->name }}</td>
                                <td class="text-truncate" style="max-width: 300px;">{{ $item->message }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'unread' ? 'bg-danger' : 'bg-secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $item->id) }}" class="btn btn-dark btn-sm rounded-3">Buka</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada pesan ibadah.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection