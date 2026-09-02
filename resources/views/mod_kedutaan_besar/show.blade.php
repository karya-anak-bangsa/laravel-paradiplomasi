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

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Data - {{ $kedutaanBesar->nama_negara }}</h3>
                </div>
                <div class="card-body">

                    {{-- format undangan --}}
                    <div class="hr-text hr-text-start">Format Undangan</div>
                    @if ($kedutaanBesar->format_undangan)
                        <p class="badge bg-teal-lt text-teal-lt-fg fs-4 mb-0">{{ $kedutaanBesar->format_undangan }}</p>
                    @else
                        <p class="badge bg-primary-lt fs-4 mb-0">Belum ada catatan format undangan.</p>
                    @endif
                    {{-- format undangan --}}

                    <div class="hr-text hr-text-start">Diplomasi</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <span class="flag flag-md flag-country-{{ $kedutaanBesar->kode_negara }} me-2"></span>
                                <span class="fw-bold">{{ $kedutaanBesar->nama_negara }}</span>
                            </div>
                        </div>
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
                    </div>

                    <div class="hr-text hr-text-start">Kontak</div>
                    <div class="datagrid align-items-center">
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

                        {{-- filler kosong biar jumlah item = 5, samain lebar kolom sama section Diplomasi/Lokasi --}}
                        <div class="datagrid-item">
                            <div class="datagrid-title"></div>
                            <div class="datagrid-content"></div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title"></div>
                            <div class="datagrid-content"></div>
                        </div>
                    </div>

                    <div class="hr-text hr-text-start">Lokasi</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Alamat</div>
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

                    <div class="hr-text hr-text-start">Peta</div>
                    @if ($kedutaanBesar->latitude && $kedutaanBesar->longitude)
                        <div id="peta-lokasi" style="height: 450px; width: 100%; border-radius: 4px;"></div>
                    @else
                        <p class="text-secondary mb-0">Koordinat lokasi belum tersedia.</p>
                    @endif

                </div>
                <div class="card-footer">
                    {{-- <small class="text-danger">Diakses pada {{ now()->format('d M Y, H:i') }} WIB</small> --}}
                </div>
                {{-- card-footer --}}
            </div>
            {{-- card --}}
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Diplomasi</h3>
                </div>
                <div class="card-body">

                    <div class="mb-4">
                        <div class="hr-text hr-text-start">Diplomasi</div>
                        <div class="datagrid align-items-center">
                            <div class="datagrid-item">
                                <div class="datagrid-content d-flex align-items-center">
                                    <span class="flag flag-md flag-country-{{ $kedutaanBesar->kode_negara }} me-2"></span>
                                    <span class="fw-bold">{{ $kedutaanBesar->nama_negara }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tab-kerjasama" class="nav-link active" data-bs-toggle="tab" role="tab">Kerjasama</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-kolaborasi" class="nav-link" data-bs-toggle="tab" role="tab">Kolaborasi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-undangan" class="nav-link" data-bs-toggle="tab" role="tab">Undangan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-audiensi" class="nav-link" data-bs-toggle="tab" role="tab">Audiensi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-kunjungan" class="nav-link" data-bs-toggle="tab" role="tab">Kunjungan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-acara-dki" class="nav-link" data-bs-toggle="tab" role="tab">Acara DKI</a>
                            </li>
                        </ul>

                        <div class="tab-content pt-3">

                            {{-- Kerjasama --}}
                            <div class="tab-pane active show" id="tab-kerjasama" role="tabpanel">
                                @forelse ($kedutaanBesar->kerjasama as $item)
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kerjasama }}</span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <div class="text-body">{{ str($item->kerjasama)->stripTags() }}</div>
                                                    <div class="text-secondary text-truncate mt-n1">
                                                        {{ str($item->rangkuman)->stripTags()->limit(120) }}
                                                    </div>
                                                </div>
                                                <div class="col-auto text-secondary" style="white-space: nowrap;">
                                                    {{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}
                                                    @if ($item->tanggal_selesai)
                                                        &ndash; {{ $item->tanggal_selesai->format('d M Y') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-secondary mb-0">Belum ada riwayat kerjasama untuk kedutaan ini.</p>
                                @endforelse
                            </div>

                            {{-- Kolaborasi --}}
                            <div class="tab-pane" id="tab-kolaborasi" role="tabpanel">
                                @forelse ($kedutaanBesar->kolaborasi as $item)
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kolaborasi }}</span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <div class="text-body">{{ str($item->kolaborasi)->stripTags() }}</div>
                                                    <div class="text-secondary text-truncate mt-n1">
                                                        {{ str($item->rangkuman)->stripTags()->limit(120) }}
                                                    </div>
                                                </div>
                                                <div class="col-auto text-secondary" style="white-space: nowrap;">
                                                    {{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}
                                                    @if ($item->tanggal_selesai)
                                                        &ndash; {{ $item->tanggal_selesai->format('d M Y') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-secondary mb-0">Belum ada riwayat kolaborasi untuk kedutaan ini.</p>
                                @endforelse
                            </div>

                            {{-- Modul belum dibangun --}}
                            <div class="tab-pane" id="tab-undangan" role="tabpanel">
                                <p class="text-secondary mb-0">Belum tersedia. Modul Undangan akan dikembangkan pada tahap berikutnya.</p>
                            </div>
                            <div class="tab-pane" id="tab-audiensi" role="tabpanel">
                                <p class="text-secondary mb-0">Belum tersedia. Modul Audiensi akan dikembangkan pada tahap berikutnya.</p>
                            </div>
                            <div class="tab-pane" id="tab-kunjungan" role="tabpanel">
                                <p class="text-secondary mb-0">Belum tersedia. Modul Kunjungan akan dikembangkan pada tahap berikutnya.</p>
                            </div>
                            <div class="tab-pane" id="tab-acara-dki" role="tabpanel">
                                <p class="text-secondary mb-0">Belum tersedia. Modul Acara DKI akan dikembangkan pada tahap berikutnya.</p>
                            </div>

                        </div>
                        {{-- tab-content --}}
                    </div>

                </div>
                <div class="card-footer">
                    {{-- <small class="text-danger">Diakses pada {{ now()->format('d M Y, H:i') }} WIB</small> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // koordinat belum ada, tidak perlu render peta
            const elPeta = document.getElementById('peta-lokasi');
            if (!elPeta) return;

            const lokasi = [{{ $kedutaanBesar->latitude }}, {{ $kedutaanBesar->longitude }}];

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
                .bindPopup('{{ $kedutaanBesar->nama_negara }}')
                .openPopup();
        });
    </script>
@endpush
