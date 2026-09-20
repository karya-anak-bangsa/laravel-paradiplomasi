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
                                <th style="width: 30%" class="text-start">Kerjasama</th>
                                <th style="width: 12%" class="text-start">Tanggal Diterima</th>
                                <th style="width: 12%" class="text-start">Tanggal Selesai</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->kerjasama as $item)
                                <tr>
                                    <td class="text-start">{{ str($item->kerjasama)->stripTags() }}</td>
                                    <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $item->status_badge_color }}" style="font-size: inherit;">{{ $item->status_kerjasama }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('kerjasama.edit', $item->id_kerjasama) }}" class="btn btn-icon btn-warning">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
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
                                    <h3 class="modal-title">Rincian Kerjasama - {{ $kedutaanBesar->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $kedutaanBesar->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $kedutaanBesar->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->nama_resmi_mitra ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Kerjasama</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            @if ($item->kerjasama)
                                                {!! $item->kerjasama !!}
                                            @else
                                                <p class="text-secondary mb-0">Belum ada catatan kerjasama.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->rangkuman !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->catatan !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Status & Jadwal</div>
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
                                            <div class="datagrid-title">Triwulan</div>
                                            <div class="datagrid-content">{{ $item->triwulan_kerjasama }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status Kerjasama</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">
                                                    {{ $item->status_kerjasama }}
                                                </span>
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
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->kolaborasi as $item)
                                <tr>
                                    <td>{{ str($item->kolaborasi)->stripTags() }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}" style="font-size: inherit;">{{ $item->status_kolaborasi }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('kolaborasi.edit', $item->id_kolaborasi) }}" class="btn btn-icon btn-warning">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
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
                                    <h3 class="modal-title">Rincian Kolaborasi - {{ $kedutaanBesar->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $kedutaanBesar->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $kedutaanBesar->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->nama_resmi_mitra ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Isi Kolaborasi</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            @if ($item->kolaborasi)
                                                {!! $item->kolaborasi !!}
                                            @else
                                                <p class="text-secondary mb-0">Belum ada catatan kolaborasi.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->rangkuman !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->catatan !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Status & Jadwal</div>
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
                                            <div class="datagrid-title">Triwulan</div>
                                            <div class="datagrid-content">{{ $item->triwulan_kolaborasi }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status Kolaborasi</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">
                                                    {{ $item->status_kolaborasi }}
                                                </span>
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
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->undangan as $item)
                                <tr>
                                    <td>{{ str($item->acara)->stripTags() }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}" style="font-size: inherit;">{{ $item->status_undangan }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('undangan.edit', $item->id_undangan) }}" class="btn btn-icon btn-warning">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
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
                                    <h3 class="modal-title">Rincian Undangan - {{ $kedutaanBesar->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $kedutaanBesar->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $kedutaanBesar->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->nama_resmi_mitra ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Acara</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            @if ($item->acara)
                                                {!! $item->acara !!}
                                            @else
                                                <p class="text-secondary mb-0">Belum ada catatan acara.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->rangkuman !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->catatan !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Status & Jadwal</div>
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
                                            <div class="datagrid-title">Triwulan</div>
                                            <div class="datagrid-content">{{ $item->triwulan_undangan }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status Undangan</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">
                                                    {{ $item->status_undangan }}
                                                </span>
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
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->audiensi as $item)
                                <tr>
                                    <td>{{ str($item->topik)->stripTags() }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}" style="font-size: inherit;">{{ $item->status_audiensi }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('audiensi.edit', $item->id_audiensi) }}" class="btn btn-icon btn-warning">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
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
                                    <h3 class="modal-title">Rincian Audiensi - {{ $kedutaanBesar->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $kedutaanBesar->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $kedutaanBesar->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->nama_resmi_mitra ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Topik</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            @if ($item->topik)
                                                {!! $item->topik !!}
                                            @else
                                                <p class="text-secondary mb-0">Belum ada catatan topik.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->rangkuman !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->catatan !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Status & Jadwal</div>
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
                                            <div class="datagrid-title">Triwulan</div>
                                            <div class="datagrid-content">{{ $item->triwulan_audiensi }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status Audiensi</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">
                                                    {{ $item->status_audiensi }}
                                                </span>
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
                                <th style="width: 12%">Tanggal Diterima</th>
                                <th style="width: 12%">Tanggal Selesai</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kedutaanBesar->kunjungan as $item)
                                <tr>
                                    <td>{{ str($item->perihal)->stripTags() }}</td>
                                    <td>{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_color }}" style="font-size: inherit;">{{ $item->status_kunjungan }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('kunjungan.edit', $item->id_kunjungan) }}" class="btn btn-icon btn-warning">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
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
                                    <h3 class="modal-title">Rincian Kunjungan - {{ $kedutaanBesar->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $kedutaanBesar->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $kedutaanBesar->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $kedutaanBesar->mitra->nama_resmi_mitra ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Perihal</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            @if ($item->perihal)
                                                {!! $item->perihal !!}
                                            @else
                                                <p class="text-secondary mb-0">Belum ada catatan perihal.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Rangkuman</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->rangkuman !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Catatan</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            {!! $item->catatan !!}
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Status & Jadwal</div>
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
                                            <div class="datagrid-title">Triwulan</div>
                                            <div class="datagrid-content">{{ $item->triwulan_kunjungan }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status Kunjungan</div>
                                            <div class="datagrid-content">
                                                <span class="badge {{ $item->status_badge_color }}">
                                                    {{ $item->status_kunjungan }}
                                                </span>
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
