<!DOCTYPE html>
<html lang="id">

    <head>

        {{-- Metadata & SEO --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <meta name="description" content="Biro Kerjasama Daerah Setda Provinsi DKI Jakarta">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Paradiplomatic Compass Analytical System</title>

        {{-- Favicon --}}
        <link rel="icon" href="{{ asset('img/dki-jakarta.webp') }}" type="image/webp">

        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

        {{-- Tabler Core --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler.min.css') }}" />

        {{-- Vendor library base CSS (loaded BEFORE tabler-vendors.min.css, since tabler-vendors provides
             Tabler-themed overrides on top of these libraries' own structural CSS) --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/libs/apexcharts/dist/apexcharts.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/libs/tom-select/dist/css/tom-select.min.css') }}" />

        {{-- Tabler theme layers (must load AFTER the vendor libs above so Tabler's overrides win) --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-vendors.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-flags.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-socials.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-payments.min.css') }}" />

        {{-- Plugin Stylesheets (FontAwesome & DataTables, not themed by tabler-vendors) --}}
        <link rel="stylesheet" href="{{ asset('template-plugins/fontawesome-6.7.2/css/all.min.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" />

        {{-- Custom Stylesheet (always last, so it can override anything above) --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-custom/tabler-custom.css') }}" />

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

        {{-- Core Libraries & Framework JS (jQuery dipindah ke atas agar aman untuk plugin turunan) --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="{{ asset('template-backend/tabler-core-1.4.0/dist/js/tabler.min.js') }}"></script>
        <script src="{{ asset('template-backend/tabler-core-1.4.0/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>

        {{-- Tom Select: library JS immediately followed by its own init block --}}
        <script src="{{ asset('template-backend/tabler-core-1.4.0/dist/libs/tom-select/dist/js/tom-select.popular.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select.tom-select').forEach(function(select) {
                    new TomSelect(select, {
                        create: false,
                        allowEmptyOption: false,
                        plugins: ['dropdown_input'],
                    });
                });
            });
        </script>

        {{-- HugeRTE (WYSIWYG): library JS immediately followed by its own init block --}}
        <script src="{{ asset('template-backend/tabler-core-1.4.0/dist/libs/hugerte/hugerte.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (document.querySelector('textarea.wysiwyg')) {
                    hugeRTE.init({
                        selector: 'textarea.wysiwyg',
                        height: 400,
                        menubar: false,
                        statusbar: false,
                        plugins: [
                            'advlist', 'autolink', 'lists', 'link', 'charmap',
                            'preview', 'anchor', 'searchreplace', 'visualblocks',
                            'code', 'fullscreen', 'wordcount',
                        ],
                        toolbar: 'undo redo | formatselect | ' +
                            'bold italic backcolor | alignleft aligncenter ' +
                            'alignright alignjustify | bullist numlist outdent indent | ' +
                            'removeformat',
                        content_style: 'body { font-family: "Inter", "Roboto", "Quicksand", sans-serif; font-size: 14px; }',
                    });
                }
            });
        </script>

        {{-- DataTables: library JS immediately followed by its own init block --}}
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
                        order: [],
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
