<!DOCTYPE html>
<html lang="id">

    <head>

        {{-- metadata --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <meta name="description" content="Biro Kerjasama Daerah Setda Provinsi DKI Jakarta">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Paradiplomatic Compass Analytical System</title>

        {{-- set icon --}}
        <link rel="icon" href="{{ asset('img/dki-jakarta.webp') }}" type="image/webp">

        {{-- stylesheet tabler core 1.4.0 --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-vendors.min.css') }}" />

        {{-- stylesheet tabler custom --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-custom/tabler-custom.css') }}" />

    </head>

    <body>
        <div class="page page-center">
            <div class="container container-tight">

                {{-- 1. Logo + Brand --}}
                <div class="d-flex flex-column align-items-center justify-content-center mb-4">
                    <img src="{{ asset('img/dki-jakarta.webp') }}"
                        alt="Logo DKI Jakarta"
                        style="height: 80px; width: auto;"
                        class="mb-2" />
                    <span class="text-dark fs-2 fw-bold">Paradiplomatic Compass Analytical System</span>
                    <span class="text-secondary fs-3">Biro Kerjasama Daerah Setda Provinsi DKI Jakarta</span>
                </div>

                {{-- 2. Form login --}}
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Masuk ke akun Anda</h2>
                        <form action="{{ route('dashboard.index') }}" method="GET" autocomplete="off" novalidate>

                            <div class="mb-3">
                                <label class="form-label">Alamat email</label>
                                <input type="email" class="form-control" placeholder="Alamat email Anda" autocomplete="off" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kata sandi</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control" placeholder="Kata sandi Anda" autocomplete="off" />
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary" title="Tampilkan password">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" />
                                    <span class="form-check-label">Ingat saya di perangkat ini</span>
                                </label>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">Sign in</button>
                            </div>

                        </form>
                    </div>
                </div>
                {{-- card --}}

            </div>
            {{-- container-tight --}}
        </div>
        {{-- page page-center --}}

        {{-- scripts tabler 1.4.0 --}}
        <script src="{{ asset('template-backend/tabler-core-1.4.0/dist/js/tabler.min.js') }}"></script>

    </body>

</html>
