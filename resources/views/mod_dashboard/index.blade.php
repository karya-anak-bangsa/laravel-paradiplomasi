@extends('template.app')

@section('nav-dashboard', 'active')
@section('page-header')
    <x-page-header title="Dashboard" />
@endsection

@section('page-content')

    {{-- Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta --}}
    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta</h3>
                </div>
                <div class="card-body">

                    <div class="row row-cards">
                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-blue-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-home">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12.707 2.293l9 9c.63 .63 .184 1.707 -.707 1.707h-1v6a3 3 0 0 1 -3 3h-1v-7a3 3 0 0 0 -2.824 -2.995l-.176 -.005h-2a3 3 0 0 0 -3 3v7h-1a3 3 0 0 1 -3 -3v-6h-1c-.89 0 -1.337 -1.077 -.707 -1.707l9 -9a1 1 0 0 1 1.414 0m.293 11.707a1 1 0 0 1 1 1v7h-4v-7a1 1 0 0 1 .883 -.993l.117 -.007z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">{{ $dash_akumulasi['kedutaan_besar'] }} Data</div>
                                            <div class="text-secondary">Jumlah Kedutaan Besar</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-green-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-folders">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 2a1 1 0 0 1 .707 .293l1.708 1.707h4.585a3 3 0 0 1 2.995 2.824l.005 .176v7a3 3 0 0 1 -3 3h-1v1a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-9a3 3 0 0 1 3 -3h1v-1a3 3 0 0 1 3 -3zm-6 6h-1a1 1 0 0 0 -1 1v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1 -1v-1h-7a3 3 0 0 1 -3 -3z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">{{ $dash_akumulasi['kerjasama'] }} Data</div>
                                            <div class="text-secondary">Jumlah Kerjasama</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-yellow-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-thumb-up">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M13 3a3 3 0 0 1 2.995 2.824l.005 .176v4h2a3 3 0 0 1 2.98 2.65l.015 .174l.005 .176l-.02 .196l-1.006 5.032c-.381 1.626 -1.502 2.796 -2.81 2.78l-.164 -.008h-8a1 1 0 0 1 -.993 -.883l-.007 -.117l.001 -9.536a1 1 0 0 1 .5 -.865a2.998 2.998 0 0 0 1.492 -2.397l.007 -.202v-1a3 3 0 0 1 3 -3z" />
                                                    <path d="M5 10a1 1 0 0 1 .993 .883l.007 .117v9a1 1 0 0 1 -.883 .993l-.117 .007h-1a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-7a2 2 0 0 1 1.85 -1.995l.15 -.005h1z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">{{ $dash_akumulasi['kolaborasi'] }} Data</div>
                                            <div class="text-secondary">Jumlah Kolaborasi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-red-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-mail">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M22 7.535v9.465a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-9.465l9.445 6.297l.116 .066a1 1 0 0 0 .878 0l.116 -.066l9.445 -6.297z" />
                                                    <path d="M19 4c1.08 0 2.027 .57 2.555 1.427l-9.555 6.37l-9.555 -6.37a2.999 2.999 0 0 1 2.354 -1.42l.201 -.007h14z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">{{ $dash_akumulasi['undangan'] }} Data</div>
                                            <div class="text-secondary">Jumlah Undangan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-blue-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-message-circle">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5.821 4.91c3.899 -2.765 9.468 -2.539 13.073 .535c3.667 3.129 4.168 8.238 1.152 11.898c-2.841 3.447 -7.965 4.583 -12.231 2.805l-.233 -.101l-4.374 .931l-.04 .006l-.035 .007h-.018l-.022 .005h-.038l-.033 .004l-.021 -.001l-.023 .001l-.033 -.003h-.035l-.022 -.004l-.022 -.002l-.035 -.007l-.034 -.005l-.016 -.004l-.024 -.005l-.049 -.016l-.024 -.005l-.011 -.005l-.022 -.007l-.045 -.02l-.03 -.012l-.011 -.006l-.014 -.006l-.031 -.018l-.045 -.024l-.016 -.011l-.037 -.026l-.04 -.027l-.002 -.004l-.013 -.009l-.043 -.04l-.025 -.02l-.006 -.007l-.056 -.062l-.013 -.014l-.011 -.014l-.039 -.056l-.014 -.019l-.005 -.01l-.042 -.073l-.007 -.012l-.004 -.008l-.007 -.012l-.014 -.038l-.02 -.042l-.004 -.016l-.004 -.01l-.017 -.061l-.007 -.018l-.002 -.015l-.005 -.019l-.005 -.033l-.008 -.042l-.002 -.031l-.003 -.01v-.016l-.004 -.054l.001 -.036l.001 -.023l.002 -.053l.004 -.025v-.019l.008 -.035l.005 -.034l.005 -.02l.004 -.02l.018 -.06l.003 -.013l1.15 -3.45l-.022 -.037c-2.21 -3.747 -1.209 -8.391 2.413 -11.119z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">{{ $dash_akumulasi['audiensi'] }} Data</div>
                                            <div class="text-secondary">Jumlah Audiensi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-green-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                                    <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">{{ $dash_akumulasi['kunjungan'] }} Data</div>
                                            <div class="text-secondary">Jumlah Kunjungan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-yellow-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-calendar-week">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M16 2c.183 0 .355 .05 .502 .135l.033 .02c.28 .177 .465 .49 .465 .845v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 .514 -.874l.093 -.046l.066 -.025l.1 -.029l.107 -.019l.12 -.007q .083 0 .161 .013l.122 .029l.04 .012l.06 .023c.328 .135 .568 .44 .61 .806l.007 .117v1h6v-1a1 1 0 0 1 1 -1m3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16z" />
                                                    <path d="M9.015 13a1 1 0 0 1 -1 1a1.001 1.001 0 1 1 -.005 -2c.557 0 1.005 .448 1.005 1" />
                                                    <path d="M13.015 13a1 1 0 0 1 -1 1a1.001 1.001 0 1 1 -.005 -2c.557 0 1.005 .448 1.005 1" />
                                                    <path d="M17.02 13a1 1 0 0 1 -1 1a1.001 1.001 0 1 1 -.005 -2c.557 0 1.005 .448 1.005 1" />
                                                    <path d="M12.02 15a1 1 0 0 1 0 2a1.001 1.001 0 1 1 -.005 -2z" />
                                                    <path d="M9.015 16a1 1 0 0 1 -1 1a1.001 1.001 0 1 1 -.005 -2c.557 0 1.005 .448 1.005 1" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Acara DKI</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Analisa Statistik Pelayanan Perwakilan Negara Asing --}}
    <div class="row row-cards mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Analisa Statistik Pelayanan Perwakilan Negara Asing</h3>
                </div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mitra Diplomatik Paling Aktif</h3>
                </div>
                <div class="card-body">
                    <div class="divide-y">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="flag flag-sm flag-country-us"></span>
                            </div>
                            <div class="col-auto">
                                <div class="text-truncate">
                                    <span class="fst-normal mb-0">Kedutaan Besar Amerika Serikat</span>
                                </div>
                                <div class="text-secondary">
                                    <small class="fst-italic mb-0">Embassy of the United States of America</small>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="flag flag-sm flag-country-gb"></span>
                            </div>
                            <div class="col-auto">
                                <div class="text-truncate">
                                    <span class="fst-normal mb-0">Kedutaan Besar Britania Raya</span>
                                </div>
                                <div class="text-secondary">
                                    <small class="fst-italic mb-0">Embassy of the United Kingdom</small>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="flag flag-sm flag-country-de"></span>
                            </div>
                            <div class="col-auto">
                                <div class="text-truncate">
                                    <span class="fst-normal mb-0">Kedutaan Besar Republik Federal Jerman</span>
                                </div>
                                <div class="text-secondary">
                                    <small class="fst-italic mb-0">Embassy of the Federal Republic of Germany</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Peta Sebaran & Pencarian Lokasi Kedutaan Besar --}}
    <div class="row row-cards mb-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Peta Sebaran & Pencarian Lokasi Kedutaan Besar</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div id="peta-kedutaan" style="height: 500px; width: 100%; border-radius: 4px;"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <input type="text" id="cari-kedutaan" class="form-control"
                                    placeholder="Cari nama negara..." />
                            </div>
                            <div id="daftar-kedutaan" class="list-group list-group-flush"
                                style="height: 444px; overflow-y: auto;">
                                @foreach ($daftarKedutaan as $kedutaan)
                                    <button type="button"
                                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 btn-cari-kedutaan"
                                        data-lat="{{ $kedutaan->latitude }}"
                                        data-lng="{{ $kedutaan->longitude }}"
                                        data-nama="{{ $kedutaan->nama_negara }}">
                                        <span class="flag flag-sm flag-country-{{ $kedutaan->kode_negara }}"></span>
                                        <span class="text-truncate">{{ $kedutaan->nama_negara }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lokasi = [-6.2023, 106.8315]; // Balai Kota DKI Jakarta

            const peta = L.map('peta-kedutaan', {
                zoomControl: true,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                boxZoom: false,
                touchZoom: false,
                keyboard: false,
                dragging: true,
            }).setView(lokasi, 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(peta);

            // simpan referensi tiap marker berdasarkan nama negara
            const markerKedutaan = {};

            @foreach ($daftarKedutaan as $kedutaan)
                markerKedutaan['{{ $kedutaan->nama_negara }}'] = L.marker([{{ $kedutaan->latitude }}, {{ $kedutaan->longitude }}])
                    .addTo(peta)
                    .bindPopup('{{ $kedutaan->nama_negara }}');
            @endforeach

            // klik nama kedutaan di daftar -> peta fokus ke lokasinya
            document.querySelectorAll('.btn-cari-kedutaan').forEach(function(tombol) {
                tombol.addEventListener('click', function() {
                    const lat = parseFloat(this.dataset.lat);
                    const lng = parseFloat(this.dataset.lng);
                    const nama = this.dataset.nama;

                    peta.flyTo([lat, lng], 15);
                    if (markerKedutaan[nama]) {
                        markerKedutaan[nama].openPopup();
                    }
                });
            });

            // filter daftar berdasarkan kata kunci pencarian
            const inputCari = document.getElementById('cari-kedutaan');
            inputCari.addEventListener('input', function() {
                const kataKunci = this.value.toLowerCase();

                document.querySelectorAll('#daftar-kedutaan .btn-cari-kedutaan').forEach(function(item) {
                    const namaNegara = item.dataset.nama.toLowerCase();
                    const cocok = namaNegara.includes(kataKunci);

                    item.classList.toggle('d-none', !cocok);
                });
            });
        });
    </script>
@endpush
