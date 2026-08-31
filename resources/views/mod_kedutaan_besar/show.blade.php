@extends('template.app')

{{-- content --}}
@section('nav-kedutaan-besar', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kedutaan Besar"
        back-route="kedutaan-besar.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row g-3">

        {{-- kolom kiri : informasi utama --}}
        <div class="col-lg-8">

            {{-- identitas kedutaan (bendera + identitas + kontak + format undangan) --}}
            <div class="card mb-3">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <span class="flag flag-lg flag-country-{{ $kedutaanBesar->kode_negara }} me-2"></span>
                        <div>
                            <h3 class="card-title mb-0">{{ $kedutaanBesar->nama_negara }}</h3>
                            <div class="text-secondary">{{ $kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    {{-- identitas --}}
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (ID)</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (EN)</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Diplomat</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->nama_diplomat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Jabatan Diplomat</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->jabatan_diplomat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Website</div>
                            <div class="datagrid-content">
                                @if ($kedutaanBesar->website)
                                    <a href="{{ $kedutaanBesar->website }}" target="_blank" rel="noopener">{{ $kedutaanBesar->website }}</a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        {{-- <div class="datagrid-item">
                            <div class="datagrid-title">Status</div>
                            <div class="datagrid-content">
                                <span class="badge {{ $kedutaanBesar->active_badge_color }}">
                                    {{ $kedutaanBesar->active_label }}
                                </span>
                            </div>
                        </div> --}}
                    </div>
                    {{-- identitas --}}

                    <div class="hr-text hr-text-left mt-4">Kontak</div>

                    {{-- kontak --}}
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Telepon Kantor</div>
                            <div class="datagrid-content">
                                @forelse ($kedutaanBesar->telepon_kantor_array as $telepon)
                                    <div>{{ $telepon }}</div>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Email Kantor</div>
                            <div class="datagrid-content">
                                @forelse ($kedutaanBesar->email_kantor_array as $email)
                                    <div>{{ $email }}</div>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                    </div>
                    {{-- kontak --}}

                    <div class="hr-text hr-text-left mt-4">Format Undangan</div>

                    {{-- format undangan --}}
                    @if ($kedutaanBesar->format_undangan)
                        <p class="mb-0" style="white-space: pre-line;">{{ $kedutaanBesar->format_undangan }}</p>
                    @else
                        <p class="text-secondary mb-0">Belum ada catatan format undangan.</p>
                    @endif
                    {{-- format undangan --}}

                </div>
            </div>
            {{-- identitas kedutaan --}}

            {{-- alamat --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Alamat</h3>
                </div>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Alamat Lengkap</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->alamat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kelurahan</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kelurahan ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kecamatan</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kecamatan ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kota</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kota ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kode Pos</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kode_pos ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- alamat --}}

        </div>
        {{-- kolom kiri --}}

        {{-- kolom kanan : lokasi (peta + koordinat) --}}
        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lokasi</h3>
                </div>
                <div class="card-body">
                    @if ($kedutaanBesar->latitude && $kedutaanBesar->longitude)
                        {{-- peta leaflet --}}
                        <div id="peta-lokasi" style="height: 260px; border-radius: var(--tblr-border-radius);" class="mb-3"></div>
                        {{-- peta leaflet --}}

                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Latitude</div>
                                <div class="datagrid-content">{{ $kedutaanBesar->latitude }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Longitude</div>
                                <div class="datagrid-content">{{ $kedutaanBesar->longitude }}</div>
                            </div>
                        </div>
                    @else
                        <p class="text-secondary mb-0">Koordinat belum tersedia.</p>
                    @endif
                </div>
            </div>

        </div>
        {{-- kolom kanan --}}

    </div>
@endsection

@if ($kedutaanBesar->latitude && $kedutaanBesar->longitude)
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const peta = L.map('peta-lokasi').setView([{{ $kedutaanBesar->latitude }}, {{ $kedutaanBesar->longitude }}], 16);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                }).addTo(peta);

                L.marker([{{ $kedutaanBesar->latitude }}, {{ $kedutaanBesar->longitude }}])
                    .addTo(peta)
                    .bindPopup(@json($kedutaanBesar->nama_negara));
            });
        </script>
    @endpush
@endif
