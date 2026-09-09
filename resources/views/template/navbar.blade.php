<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">

        <div class="navbar navbar-light">
            <div class="container-fluid">

                <div class="row flex-column flex-md-row flex-fill align-items-center">
                    <div class="col">

                        <ul class="navbar-nav">
                            <li class="nav-item @yield('nav-dashboard')">
                                <a class="nav-link" href="{{ route('dashboard.index') }}">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-chart-pie me-2"></i>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown @yield('nav-mitra-kami')">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-graduation-cap me-2"></i>Mitra Kami</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('kedutaan-besar.index') }}">Mitra PNA</a>
                                    <a class="dropdown-item" href="{{-- route('kedutaan-besar.index') --}}">Mitra Non PNA</a>
                                </div>
                            </li>
                            <li class="nav-item @yield('nav-kerjasama')">
                                <a class="nav-link" href="{{ route('kerjasama.index') }}">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-folder-closed me-2"></i>Kerjasama</span>
                                </a>
                            </li>
                            <li class="nav-item @yield('nav-kolaborasi')">
                                <a class="nav-link" href="{{ route('kolaborasi.index') }}">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-thumbs-up me-2"></i>Kolaborasi </span>
                                </a>
                            </li>
                            <li class="nav-item @yield('nav-undangan')">
                                <a class="nav-link" href="{{ route('undangan.index') }}">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-envelope me-2"></i>Undangan </span>
                                </a>
                            </li>
                            <li class="nav-item @yield('nav-audiensi')">
                                <a class="nav-link" href="{{ route('audiensi.index') }}">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-comments me-2"></i>Audiensi </span>
                                </a>
                            </li>
                            <li class="nav-item @yield('nav-kunjungan')">
                                <a class="nav-link" href="{{ route('kunjungan.index') }}">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-user-graduate me-2"></i>Kunjungan </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown @yield('nav-kegiatan')">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <span class="nav-link-title text-dark"><i class="fa-solid fa-calendar-days me-2"></i>Kegiatan</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('acara-dki.index') }}">Acara DKI</a>
                                    <a class="dropdown-item" href="{{ route('tanggal-penting.index') }}">Tanggal Penting</a>
                                </div>
                            </li>
                            @if (session('auth_role') === 'admin')
                                {{-- <li class="nav-item dropdown @yield('nav-administrasi')">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <span class="nav-link-title"><i class="fa-solid fa-layer-group me-2"></i>Administrasi Biro KSD</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Generate Nota Dinas</a>
                                        <a class="dropdown-item" href="#">Generate Surat Administrasi</a>
                                        <a class="dropdown-item" href="#">Disposisi Surat Masuk</a>
                                        <a class="dropdown-item" href="#">Disposisi Surat Keluar</a>
                                    </div>
                                </li> --}}
                                <li class="nav-item dropdown @yield('nav-pengaturan')">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <span class="nav-link-title text-dark"><i class="fa-solid fa-gear me-2"></i>Pengaturan Sistem</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Akun Pengguna</a>
                                        <a class="dropdown-item" href="#">Riwayat Aktivitas</a>
                                    </div>
                                </li>
                            @endif
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
