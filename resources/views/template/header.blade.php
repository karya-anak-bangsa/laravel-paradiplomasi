<header class="navbar navbar-light navbar-expand-md d-print-none">
    <div class="container-fluid">

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
            <div class="nav-item d-none d-md-flex me-0">
                <div class="btn-list">
                    <a href="" class="btn btn-primary">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
                    </a>
                </div>
            </div>
        </div>
        {{-- header-right --}}

    </div>
</header>
