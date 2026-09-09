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
    <div class="tab-content my-3">

        {{-- Kerjasama --}}
        <div class="tab-pane active show" id="tab-kerjasama" role="tabpanel">
            @if ($kedutaanBesar->kerjasama->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%">Kerjasama</th>
                                <th>Rangkuman</th>
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->kerjasama as $item)
                                <tr>
                                    <td>{{ str($item->kerjasama)->stripTags() }}</td>
                                    <td>{{ str($item->rangkuman)->stripTags()->limit(300) }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kerjasama }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal-kerjasama-{{ $item->id_kerjasama }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach ($kedutaanBesar->kerjasama as $item)
                    <div class="modal modal-blur fade" id="modal-kerjasama-{{ $item->id_kerjasama }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Kerjasama</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="mb-3">{{ str($item->kerjasama)->stripTags() }}</h2>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">{!! $item->rangkuman ?: '<span class="text-secondary">Tidak ada rangkuman.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">{!! $item->catatan ?: '<span class="text-secondary">Tidak ada catatan.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Dokumen</div>
                                    <a href="{{-- asset('storage/'.$item->file_dokumen) --}}" target="_blank" rel="noopener" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-download me-1"></i>Unduh Dokumen
                                    </a>

                                    <div class="hr-text hr-text-start">Informasi Lainnya</div>
                                    <div class="datagrid align-items-center">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Diterima</div>
                                            <div class="datagrid-content">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Selesai</div>
                                            <div class="datagrid-content">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kerjasama }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-danger mb-0">Belum ada riwayat kerjasama untuk kedutaan ini.</p>
            @endif
        </div>

        {{-- Kolaborasi --}}
        <div class="tab-pane" id="tab-kolaborasi" role="tabpanel">
            @if ($kedutaanBesar->kolaborasi->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%">Kolaborasi</th>
                                <th>Rangkuman</th>
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->kolaborasi as $item)
                                <tr>
                                    <td>{{ str($item->kolaborasi)->stripTags() }}</td>
                                    <td>{{ str($item->rangkuman)->stripTags()->limit(300) }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kolaborasi }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal-kolaborasi-{{ $item->id_kolaborasi }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach ($kedutaanBesar->kolaborasi as $item)
                    <div class="modal modal-blur fade" id="modal-kolaborasi-{{ $item->id_kolaborasi }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Kolaborasi</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="mb-3">{{ str($item->kolaborasi)->stripTags() }}</h2>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">{!! $item->rangkuman ?: '<span class="text-secondary">Tidak ada rangkuman.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">{!! $item->catatan ?: '<span class="text-secondary">Tidak ada catatan.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Dokumen</div>
                                    <a href="{{-- asset('storage/'.$item->file_dokumen) --}}" target="_blank" rel="noopener" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-download me-1"></i>Unduh Dokumen
                                    </a>

                                    <div class="hr-text hr-text-start">Informasi Lainnya</div>
                                    <div class="datagrid align-items-center">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Diterima</div>
                                            <div class="datagrid-content">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Selesai</div>
                                            <div class="datagrid-content">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kolaborasi }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-danger mb-0">Belum ada riwayat kolaborasi untuk kedutaan ini.</p>
            @endif
        </div>

        {{-- Undangan --}}
        <div class="tab-pane" id="tab-undangan" role="tabpanel">
            @if ($kedutaanBesar->undangan->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%">Acara</th>
                                <th>Rangkuman</th>
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->undangan as $item)
                                <tr>
                                    <td>{{ str($item->acara)->stripTags() }}</td>
                                    <td>{{ str($item->rangkuman)->stripTags()->limit(300) }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}">{{ $item->status_undangan }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal-undangan-{{ $item->id_undangan }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach ($kedutaanBesar->undangan as $item)
                    <div class="modal modal-blur fade" id="modal-undangan-{{ $item->id_undangan }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Undangan</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="mb-3">{{ str($item->acara)->stripTags() }}</h2>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">{!! $item->rangkuman ?: '<span class="text-secondary">Tidak ada rangkuman.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">{!! $item->catatan ?: '<span class="text-secondary">Tidak ada catatan.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Dokumen</div>
                                    <a href="{{-- asset('storage/'.$item->file_dokumen) --}}" target="_blank" rel="noopener" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-download me-1"></i>Unduh Dokumen
                                    </a>

                                    <div class="hr-text hr-text-start">Informasi Lainnya</div>
                                    <div class="datagrid align-items-center">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Diterima</div>
                                            <div class="datagrid-content">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Selesai</div>
                                            <div class="datagrid-content">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">{{ $item->status_undangan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-danger mb-0">Belum ada riwayat undangan untuk kedutaan ini.</p>
            @endif
        </div>

        {{-- Audiensi --}}
        <div class="tab-pane" id="tab-audiensi" role="tabpanel">
            @if ($kedutaanBesar->audiensi->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%">Topik</th>
                                <th>Rangkuman</th>
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->audiensi as $item)
                                <tr>
                                    <td>{{ str($item->topik)->stripTags() }}</td>
                                    <td>{{ str($item->rangkuman)->stripTags()->limit(300) }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}">{{ $item->status_audiensi }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal-audiensi-{{ $item->id_audiensi }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach ($kedutaanBesar->audiensi as $item)
                    <div class="modal modal-blur fade" id="modal-audiensi-{{ $item->id_audiensi }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Audiensi</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="mb-3">{{ str($item->topik)->stripTags() }}</h2>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">{!! $item->rangkuman ?: '<span class="text-secondary">Tidak ada rangkuman.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">{!! $item->catatan ?: '<span class="text-secondary">Tidak ada catatan.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Dokumen</div>
                                    <a href="{{-- asset('storage/'.$item->file_dokumen) --}}" target="_blank" rel="noopener" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-download me-1"></i>Unduh Dokumen
                                    </a>

                                    <div class="hr-text hr-text-start">Informasi Lainnya</div>
                                    <div class="datagrid align-items-center">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Diterima</div>
                                            <div class="datagrid-content">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Selesai</div>
                                            <div class="datagrid-content">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">{{ $item->status_audiensi }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-danger mb-0">Belum ada riwayat audiensi untuk kedutaan ini.</p>
            @endif
        </div>

        {{-- Kunjungan --}}
        <div class="tab-pane" id="tab-kunjungan" role="tabpanel">
            @if ($kedutaanBesar->kunjungan->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%">Perihal</th>
                                <th>Rangkuman</th>
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->kunjungan as $item)
                                <tr>
                                    <td>{{ str($item->perihal)->stripTags() }}</td>
                                    <td>{{ str($item->rangkuman)->stripTags()->limit(300) }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kunjungan }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal-kunjungan-{{ $item->id_kunjungan }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach ($kedutaanBesar->kunjungan as $item)
                    <div class="modal modal-blur fade" id="modal-kunjungan-{{ $item->id_kunjungan }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Kunjungan</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="mb-3">{{ str($item->perihal)->stripTags() }}</h2>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">{!! $item->rangkuman ?: '<span class="text-secondary">Tidak ada rangkuman.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">{!! $item->catatan ?: '<span class="text-secondary">Tidak ada catatan.</span>' !!}</div>

                                    <div class="hr-text hr-text-start">Dokumen</div>
                                    <a href="{{-- asset('storage/'.$item->file_dokumen) --}}" target="_blank" rel="noopener" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-download me-1"></i>Unduh Dokumen
                                    </a>

                                    <div class="hr-text hr-text-start">Informasi Lainnya</div>
                                    <div class="datagrid align-items-center">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Diterima</div>
                                            <div class="datagrid-content">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Selesai</div>
                                            <div class="datagrid-content">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">{{ $item->status_kunjungan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-danger mb-0">Belum ada riwayat kunjungan untuk kedutaan ini.</p>
            @endif
        </div>

        {{-- Acara DKI --}}
        <div class="tab-pane" id="tab-acara-dki" role="tabpanel">
            <p class="text-danger mb-0">Belum tersedia. Modul Acara DKI akan dikembangkan pada tahap berikutnya.</p>
        </div>

    </div>
    {{-- tab-content --}}
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
                .bindPopup(
                    '<div class="fw-bold mb-1">Kedutaan Besar {{ $kedutaanBesar->nama_negara }}</div>' +
                    '<a href="https://www.google.com/maps?q={{ $kedutaanBesar->latitude }},{{ $kedutaanBesar->longitude }}" target="_blank" rel="noopener" class="text-primary">' +
                    '<i class="fa-solid fa-map-location-dot me-1"></i>Buka di Google Maps' +
                    '</a>'
                ).openPopup();
        });
    </script>
@endpush
