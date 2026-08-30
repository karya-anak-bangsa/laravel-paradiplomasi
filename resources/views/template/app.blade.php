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

        {{-- stylesheet tabler plugin 1.4.0 --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-flags.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-socials.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-payments.min.css') }}" />

        {{-- ------------------------------------------------------------------------------------------------------------------ --}}
        {{-- Plugin ----------------------------------------------------------------------------------------------------------- --}}
        {{-- 1. fontawesome 6.7.2 --}}
        {{-- 2. datatables 2.1.8 --}}
        {{-- ------------------------------------------------------------------------------------------------------------------ --}}
        <link rel="stylesheet" href="{{ asset('template-plugins/fontawesome-6.7.2/css/all.min.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" />

        {{-- stylesheet tabler custom --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-custom/tabler-custom.css') }}" />

        @stack('styles')
    </head>

    <body>
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

        <!-- scripts jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- scripts datatables -->
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('table.datatable').forEach(function(table) {

                    const columnDefs = [];
                    table.querySelectorAll('thead th').forEach(function(th, index) {
                        if (th.dataset.orderable === 'false') {
                            columnDefs.push({
                                targets: index,
                                orderable: false
                            });
                        }
                    });

                    new DataTable(table, {
                        columnDefs,
                        pageLength: 25,
                        language: {
                            search: 'Cari:',
                            lengthMenu: 'Tampilkan _MENU_ data',
                            info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                            infoEmpty: 'Tidak ada data',
                            paginate: {
                                previous: 'Sebelumnya',
                                next: 'Berikutnya',
                            },
                        },
                    });
                });
            });
        </script>

        @stack('scripts')
    </body>

</html>
