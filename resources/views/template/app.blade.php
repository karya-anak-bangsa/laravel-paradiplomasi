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

        {{-- Tabler theme layers (must load AFTER the vendor libs above so Tabler's overrides win) --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-vendors.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-flags.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-socials.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-core-1.4.0/dist/css/tabler-payments.min.css') }}" />

        {{-- Plugin Stylesheets (FontAwesome, DataTables, Select2, Simple Notify — not themed by tabler-vendors) --}}
        <link rel="stylesheet" href="{{ asset('template-plugins/fontawesome-6.7.2/css/all.min.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.css" />

        {{-- Custom Stylesheet (always last, so it can override anything above) --}}
        <link rel="stylesheet" href="{{ asset('template-backend/tabler-custom/tabler-custom.css') }}" />

        {{-- Select2 typography fix: select2-bootstrap-5-theme hardcodes font-size:1rem on
             ".select2-results__options .select2-results__option" (and similar rules), which
             we cannot edit directly since it ships from a CDN — !important is used deliberately
             here to guarantee this Tabler-based layout's Inter/.875rem typography wins over it. --}}
        <style>
            .select2-container--bootstrap-5 .select2-selection,
            .select2-container--bootstrap-5 .select2-selection__rendered,
            .select2-container--bootstrap-5 .select2-search__field,
            .select2-container--bootstrap-5 .select2-results__option,
            .select2-container--bootstrap-5 .select2-results__group,
            .select2-dropdown {
                font-family: "Inter", "Roboto", "Quicksand", sans-serif !important;
                font-size: .875rem !important;
            }
        </style>

        @stack('styles')
    </head>

    <body class="antialiased">

        @if (session('notify'))
            <div id="notify-data"
                data-status="{{ session('notify.type') }}"
                data-text="{{ session('notify.message') }}">
            </div>
        @endif

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

        {{-- Select2: library JS immediately followed by its own init block --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('select.select2').select2({
                    theme: 'bootstrap-5',
                    width: '100%',
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

        {{-- Simple Notify: library JS immediately followed by its own init block --}}
        <script src="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const el = document.getElementById('notify-data');
                if (!el) return;

                new Notify({
                    status: el.dataset.status || 'success',
                    text: el.dataset.text || 'Operation completed',
                    effect: 'slide',
                    speed: 500,
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 5000,
                    gap: 20,
                    distance: 20,
                    position: 'right top',
                });
            });
        </script>

        {{-- SweetAlert2: library JS immediately followed by its own init block --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const confirmConfig = {
                    save: {
                        text: 'Apakah Anda yakin ingin menyimpan data ini?',
                        icon: 'success',
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'Ya, Simpan!',
                    },
                    update: {
                        text: 'Apakah Anda yakin ingin mengubah data ini?',
                        icon: 'warning',
                        confirmButtonColor: '#e6ae06',
                        confirmButtonText: 'Ya, Ubah!',
                    },
                    delete: {
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'error',
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Ya, Hapus!',
                    },
                };

                document.querySelectorAll('.confirm-submit').forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const config = confirmConfig[form.dataset.confirm] || confirmConfig.save;

                        Swal.fire({
                            title: 'Konfirmasi',
                            text: config.text,
                            icon: config.icon,
                            showCancelButton: true,
                            confirmButtonColor: config.confirmButtonColor,
                            cancelButtonColor: '#6c757e',
                            confirmButtonText: config.confirmButtonText,
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                HTMLFormElement.prototype.submit.call(form);
                            }
                        });
                    });
                });
            });
        </script>

        @stack('scripts')
    </body>

</html>
