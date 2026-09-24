<header class="navbar navbar-light navbar-expand-md d-print-none">
    <div class="container-fluid py-1">

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
            aria-controls="navbar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('dashboard.index') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('img/dki-jakarta.webp') }}"
                    alt="Logo DKI Jakarta"
                    class="navbar-brand-image"
                    style="height: 50px; width: auto;" />
            </a>
            <span>
                <span class="d-none d-md-block text-dark fs-2 pb-1">Paradiplomatic Compass Analytical System</span>
                <span class="d-none d-md-block text-secondary fs-3 pb-0">Biro Kerjasama Daerah Setda Provinsi DKI Jakarta</span>
            </span>
        </h1>
        {{-- header-left --}}

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Menu pengguna">
                    <span class="avatar avatar-md bg-primary-lt"><i class="fa-solid fa-user"></i></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ session('auth_nama') }}</div>
                        <div class="mt-1 small text-secondary">{{ session('auth_email') }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
            {{-- nav-item --}}
        </div>
        {{-- header-right --}}

    </div>
</header>
