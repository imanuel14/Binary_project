<div class="sidebar">
    <div class="p-3 text-center border-bottom border-secondary">
        @if(isset($churchProfile) && $churchProfile->logo)
            <img src="{{ asset('storage/' . $churchProfile->logo) }}" 
                 alt="Logo Gereja" 
                 class="rounded-circle mb-2" 
                 style="width: 70px; height: 70px; object-fit: cover; border: 3px solid rgba(255,255,255,0.3);">
        @else
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" 
                 style="width: 70px; height: 70px;">
                <i class="bi bi-church-fill text-primary fs-1"></i>
            </div>
        @endif
        
        <h6 class="text-white mb-0">{{ Auth::user()->role == 'admin' ? 'Admin' : 'User' }}</h6>
        <small class="text-white-50">{{ config('app.name') }}</small>
    </div>

    <ul class="sidebar-menu mt-3">
        <li class="{{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>

        @if(Auth::user()->role == 'admin')
            <li class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                <a href="{{ route('admin.programs.index') }}">
                    <i class="bi bi-calendar-event me-2"></i>Kelola Program
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <a href="{{ route('admin.contacts.index') }}" class="d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-envelope me-2"></i>Pesan Masuk</span>
                    @if(isset($unreadContacts) && $unreadContacts > 0)
                        <span class="badge bg-danger rounded-pill">{{ $unreadContacts }}</span>
                    @endif
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.church-profile.*') ? 'active' : '' }}">
                <a href="{{ route('admin.church-profile.edit') }}">
                    <i class="bi bi-building me-2"></i>Profil Gereja
                </a>
            </li>
        @endif

        @if(Auth::user()->role == 'user')
            <li class="{{ request()->routeIs('user.programs.*') ? 'active' : '' }}">
                <a href="{{ route('user.programs.index') }}">
                    <i class="bi bi-calendar-event me-2"></i>Program
                </a>
            </li>

            <li class="{{ request()->routeIs('user.contacts.*') ? 'active' : '' }}">
                <a href="{{ route('user.contacts.index') }}">
                    <i class="bi bi-chat-dots me-2"></i>Kontak Admin
                </a>
            </li>

            <li class="{{ request()->routeIs('user.profile.*') ? 'active' : '' }}">
                <a href="{{ route('user.profile.edit') }}">
                    <i class="bi bi-person-circle me-2"></i>Profil Saya
                </a>
            </li>
        @endif

        <li class="mt-4 pt-3 border-top border-secondary">
            <a href="{{ route('home') }}" target="_blank">
                <i class="bi bi-box-arrow-up-right me-2"></i>Lihat Website
            </a>
        </li>

        <li>
            <button type="button" onclick="confirmLogout()" class="btn btn-link text-white text-decoration-none w-100 text-start ps-0">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>

            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: "Anda akan keluar dari sesi ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>