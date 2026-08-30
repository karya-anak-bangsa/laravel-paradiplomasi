<!DOCTYPE html>
<html lang="id">

    <head>

        {{-- metadata --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <meta name="description" content="Biro Kerjasama Daerah Setda Provinsi DKI Jakarta">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Paradiplomatic Compass Analytical Systems</title>

        {{-- set icon --}}
        <link rel="icon" href="{{ asset('img/dki-jakarta.webp') }}" type="image/webp">

        {{-- stylesheet tabler core 1.4.0 --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-vendors.min.css') }}" />

        {{-- stylesheet tabler plugin 1.4.0 --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-flags.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-socials.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-payments.min.css') }}" />

        {{-- stylesheet fontawesome 6.7.2 --}}
        <link rel="stylesheet" href="{{ asset('template-plugins/fontawesome-6.7.2/css/all.min.css') }}">

        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" />

        @stack('styles')
    </head>

    <body class="antialiased">
        <div class="page">

            @include('template.header')
            @include('template.navbar')

            <div class="page-wrapper">

                <div class="page-header d-print-none">
                    <div class="container-fluid">
                        @yield('page-header')
                    </div>
                </div>
                {{-- page-header --}}

                <div class="page-body">
                    <div class="container-fluid">
                        @yield('page-content')
                    </div>
                </div>
                {{-- page-content --}}

                @include('template.footer')
                {{-- page-footer --}}

            </div>
            {{-- page-wrapper --}}
        </div>
        {{-- page --}}

        {{-- scripts tabler 1.4.0 --}}
        <script src="{{ asset('template-backend/tabler-core-1.4.0/dist/js/tabler.min.js') }}"></script>

        <!-- jQuery (Jika menggunakan DataTables dengan jQuery) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

        @stack('scripts')
    </body>

</html>
