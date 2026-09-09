<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-map-location-dot me-1"></i>
            Peta Sebaran & Pencarian Lokasi Kedutaan Besar
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <div id="peta-kedutaan" style="height: 500px; width: 100%; border-radius: 4px;"></div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <input type="text" id="cari-kedutaan" class="form-control" placeholder="Cari nama negara..." />
                </div>
                <div id="daftar-kedutaan" class="list-group list-group-flush" style="height: 450px; overflow-y: auto;">
                    @foreach ($daftarKedutaan as $kedutaan)
                        <button type="button"
                            class="list-group-item list-group-item-action btn-cari-kedutaan"
                            data-lat="{{ $kedutaan->latitude }}"
                            data-lng="{{ $kedutaan->longitude }}"
                            data-nama="{{ $kedutaan->nama_negara }}">
                            <div class="row align-items-start">
                                <div class="col-auto">
                                    <span class="flag flag-sm flag-country-{{ $kedutaan->kode_negara }} mt-1"></span>
                                </div>
                                <div class="col text-truncate text-start">
                                    <div class="text-dark text-truncate">
                                        <span class="fst-normal mb-0">{{ $kedutaan->nama_negara }}</span>
                                    </div>
                                    <div class="text-dark text-truncate">
                                        <small class="fst-normal mb-0">{{ $kedutaan->nama_kedutaan_besar_id }}</small>
                                    </div>
                                    <div class="text-secondary text-truncate">
                                        <small class="text-primary fst-normal mb-0">
                                            <i class="fa-solid fa-location-dot me-1"></i>{{ $kedutaan->alamat }}, {{ $kedutaan->kelurahan }}, {{ $kedutaan->kecamatan }}, {{ $kedutaan->kota }}.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
            {{-- col --}}
        </div>
        {{-- row --}}
    </div>
    {{-- card-body --}}
</div>
{{-- card --}}

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lokasi = [-6.2023, 106.8315];
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
                    .bindPopup(
                        '<div class="fw-bold mb-1">Kedutaan Besar {{ $kedutaan->nama_negara }}</div>' +
                        '<a href="https://www.google.com/maps?q={{ $kedutaan->latitude }},{{ $kedutaan->longitude }}" target="_blank" rel="noopener" class="text-primary">' +
                        '<i class="fa-solid fa-map-location-dot me-1"></i>Buka di Google Maps' +
                        '</a>'
                    );
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
