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
                        <form action="{{ route('login.process') }}" method="POST" autocomplete="off" novalidate>
                            @csrf

                            {{-- email --}}
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Alamat email Anda" autocomplete="off" />
                            </div>

                            {{-- password + tombol mata untuk menampilkan/menyembunyikan isinya --}}
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}" placeholder="Kata sandi Anda" autocomplete="off" />
                                    <span class="input-group-text">
                                        <button type="button" id="toggle-password" class="link-secondary border-0 bg-transparent p-0"
                                            title="Tampilkan password" aria-label="Tampilkan password" aria-pressed="false">
                                            {{-- ikon mata (Tabler Icons "eye") — tampil saat password tersembunyi --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-mata" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                            {{-- ikon mata dicoret (Tabler Icons "eye-off") — tampil saat password terlihat --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-mata d-none" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                                <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            {{-- remember me --}}
                            <div class="mb-3">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" />
                                    <span class="form-check-label">Ingat saya di perangkat ini</span>
                                </label>
                            </div>

                            {{-- button submit --}}
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

        {{-- tampilkan/sembunyikan password --}}
        <script>
            document.getElementById('toggle-password').addEventListener('click', function () {
                const input = document.getElementById('password');
                const terlihat = input.type === 'password';
                const label = terlihat ? 'Sembunyikan password' : 'Tampilkan password';

                input.type = terlihat ? 'text' : 'password';
                this.querySelectorAll('.icon-mata').forEach((ikon) => ikon.classList.toggle('d-none'));
                this.setAttribute('aria-pressed', terlihat);
                this.setAttribute('aria-label', label);
                this.title = label;
                input.focus();
            });
        </script>

    </body>

</html>
