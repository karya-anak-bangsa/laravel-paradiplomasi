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
                                            <span class="avatar bg-blue-lt">KB</span>
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
                                            <span class="avatar bg-green-lt">KS</span>
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
                                            <span class="avatar bg-yellow-lt">KL</span>
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
                                            <span class="avatar bg-red-lt">UD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
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
                                            <span class="avatar bg-blue-lt">AU</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
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
                                            <span class="avatar bg-green-lt">VI</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
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
                                            <span class="avatar bg-yellow-lt">EV</span>
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
                    <h3 class="card-title">Keterlibatan Tertinggi</h3>
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

    {{-- Peta Geospasial Sebaran Kedutaan Besar --}}
    <div class="row row-cards mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Peta Geospasial Sebaran Kedutaan Besar</h3>
                </div>
                <div class="card-body">
                    <div id="peta-kedutaan" style="height: 500px; width: 100%; border-radius: 4px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Peta Geospasial Sebaran Kedutaan Besar</h3>
                </div>
                <div class="card-body">
                    <div id="peta-kedutaan" style="height: 500px; width: 100%; border-radius: 4px;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const balaiKota = [-6.175392, 106.827153]; // Balai Kota DKI Jakarta

            const peta = L.map('peta-kedutaan', {
                zoomControl: false, // hilangkan tombol +/-
                scrollWheelZoom: false, // scroll mouse tidak zoom
                doubleClickZoom: false, // double click tidak zoom
                boxZoom: false, // shift+drag tidak zoom
                touchZoom: false, // pinch di touchscreen tidak zoom
                keyboard: false, // panah keyboard tidak zoom/geser via keyboard
                dragging: true, // geser tetap bisa
            }).setView(balaiKota, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(peta);

            L.marker(balaiKota).addTo(peta)
                .bindPopup('Balai Kota DKI Jakarta')
                .openPopup();
        });
    </script>
@endpush
