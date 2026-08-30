<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">

        <div class="navbar navbar-light">
            <div class="container-fluid">

                <div class="row flex-column flex-md-row flex-fill align-items-center">
                    <div class="col">

                        <ul class="navbar-nav">
                            <li class="nav-item @yield('nav-dashboard')">
                                <a class="nav-link" href="{{ route('dashboard.index') }}">
                                    <span class="nav-link-title"><i class="fa-solid fa-chart-pie me-2"></i>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item @yield('nav-kedutaan-besar')">
                                <a class="nav-link" href="{{ route('kedutaan-besar.index') }}">
                                    <span class="nav-link-title"><i class="fa-solid fa-landmark me-2"></i>Kedutaan Besar</span>
                                </a>
                            </li>
                            <li class="nav-item @yield('nav-kerjasama')">
                                <a class="nav-link" href="{{ route('kerjasama.index') }}">
                                    <span class="nav-link-title"><i class="fa-solid fa-folder-closed me-2"></i>Kerjasama</span>
                                </a>
                            </li>
                            <li class="nav-item @yield('nav-kolaborasi')">
                                <a class="nav-link" href="{{ route('kolaborasi.index') }}">
                                    <span class="nav-link-title"><i class="fa-solid fa-thumbs-up me-2"></i>Kolaborasi </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <span class="nav-link-title"><i class="fa-solid fa-envelope me-2"></i>Undangan </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <span class="nav-link-title"><i class="fa-solid fa-comments me-2"></i>Audiensi </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <span class="nav-link-title"><i class="fa-solid fa-user-graduate me-2"></i>Kunjungan </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <span class="nav-link-title"><i class="fa-solid fa-calendar-days me-2"></i>Acara DKI </span>
                                </a>
                            </li>
                        </ul>

                    </div>
                    {{-- col --}}
                </div>
                {{-- row --}}

            </div>
            {{-- container --}}
        </div>
        {{-- navbar --}}

    </div>
</header>
