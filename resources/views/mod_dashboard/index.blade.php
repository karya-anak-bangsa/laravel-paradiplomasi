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
