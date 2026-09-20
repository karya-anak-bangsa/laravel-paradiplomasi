@if ($misiAsingAsean->latitude && $misiAsingAsean->longitude)
    <div id="peta-lokasi" style="height: 450px; width: 100%; border-radius: 5px;"></div>
@else
    <p class="text-secondary mb-0">Koordinat lokasi belum tersedia.</p>
@endif

<div class="text-dark mt-3">
    <p class="fw-semibold mb-auto">Alamat Misi Asing untuk ASEAN</p>
    <p class="fw-normal mb-auto">{{ collect([$misiAsingAsean->alamat, $misiAsingAsean->kelurahan, $misiAsingAsean->kecamatan, $misiAsingAsean->kota, $misiAsingAsean->kode_pos])->filter()->implode(', ') ?:'-' }}</p>
</div>

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const elPeta = document.getElementById('peta-lokasi');
            if (!elPeta) return;

            const lokasi = [{{ $misiAsingAsean->latitude }}, {{ $misiAsingAsean->longitude }}];
            const peta = L.map('peta-lokasi', {
                zoomControl: true,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                boxZoom: false,
                touchZoom: false,
                keyboard: false,
                dragging: true,
            }).setView(lokasi, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(peta);

            L.marker(lokasi).addTo(peta)
                .bindPopup(
                    '<div class="fw-bold mb-1">Misi Asing untuk ASEAN {{ $misiAsingAsean->nama_negara }}</div>' +
                    '<a href="https://www.google.com/maps?q={{ $misiAsingAsean->latitude }},{{ $misiAsingAsean->longitude }}" target="_blank" rel="noopener" class="text-primary">' +
                    '<i class="fa-solid fa-map-location-dot me-1"></i>Buka di Google Maps' +
                    '</a>'
                ).openPopup();
        });
    </script>
@endpush
