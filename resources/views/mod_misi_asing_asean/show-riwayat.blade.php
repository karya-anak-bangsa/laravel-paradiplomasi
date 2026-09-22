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
            @if ($misiAsingAsean->kerjasama->isNotEmpty())
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
                            @foreach ($misiAsingAsean->kerjasama as $item)
                                <tr>
                                    <td class="text-start">{{ str($item->kerjasama)->stripTags() }}</td>
                                    <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td class="text-center">{{ $item->status_kerjasama }}</td>
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

                @foreach ($misiAsingAsean->kerjasama as $item)
                    <div class="modal modal-blur fade" id="modal-kerjasama-{{ $item->id_kerjasama }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Rincian Kerjasama - {{ $misiAsingAsean->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $misiAsingAsean->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $misiAsingAsean->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->nama_resmi_mitra ?? '-' }}</div>
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
                                            <div class="datagrid-content">{{ $item->status_kerjasama }}</div>
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
                <p class="text-danger mb-0">Belum ada riwayat kerjasama untuk misi ini.</p>
            @endif
        </div>

        {{-- Kolaborasi --}}
        <div class="tab-pane" id="tab-kolaborasi" role="tabpanel">
            @if ($misiAsingAsean->kolaborasi->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%" class="text-start">Kolaborasi</th>
                                <th style="width: 12%" class="text-start">Tanggal Diterima</th>
                                <th style="width: 12%" class="text-start">Tanggal Selesai</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($misiAsingAsean->kolaborasi as $item)
                                <tr>
                                    <td class="text-start">{{ str($item->kolaborasi)->stripTags() }}</td>
                                    <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td class="text-center">{{ $item->status_kolaborasi }}</td>
                                    <td class="text-center">
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

                @foreach ($misiAsingAsean->kolaborasi as $item)
                    <div class="modal modal-blur fade" id="modal-kolaborasi-{{ $item->id_kolaborasi }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Rincian Kolaborasi - {{ $misiAsingAsean->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $misiAsingAsean->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $misiAsingAsean->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->nama_resmi_mitra ?? '-' }}</div>
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
                                            <div class="datagrid-content">{{ $item->status_kolaborasi }}</div>
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
                <p class="text-danger mb-0">Belum ada riwayat kolaborasi untuk misi ini.</p>
            @endif
        </div>

        {{-- Undangan --}}
        <div class="tab-pane" id="tab-undangan" role="tabpanel">
            @if ($misiAsingAsean->undangan->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%" class="text-start">Acara</th>
                                <th style="width: 12%" class="text-start">Tanggal Diterima</th>
                                <th style="width: 12%" class="text-start">Tanggal Selesai</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($misiAsingAsean->undangan as $item)
                                <tr>
                                    <td class="text-start">{{ str($item->acara)->stripTags() }}</td>
                                    <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td class="text-center">{{ $item->status_undangan }}</td>
                                    <td class="text-center">
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

                @foreach ($misiAsingAsean->undangan as $item)
                    <div class="modal modal-blur fade" id="modal-undangan-{{ $item->id_undangan }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Rincian Undangan - {{ $misiAsingAsean->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $misiAsingAsean->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $misiAsingAsean->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->nama_resmi_mitra ?? '-' }}</div>
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
                                            <div class="datagrid-content">{{ $item->status_undangan }}</div>
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
                <p class="text-danger mb-0">Belum ada riwayat undangan untuk misi ini.</p>
            @endif
        </div>

        {{-- Audiensi --}}
        <div class="tab-pane" id="tab-audiensi" role="tabpanel">
            @if ($misiAsingAsean->audiensi->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%" class="text-start">Topik</th>
                                <th style="width: 12%" class="text-start">Tanggal Diterima</th>
                                <th style="width: 12%" class="text-start">Tanggal Selesai</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($misiAsingAsean->audiensi as $item)
                                <tr>
                                    <td class="text-start">{{ str($item->topik)->stripTags() }}</td>
                                    <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td class="text-center">{{ $item->status_audiensi }}</td>
                                    <td class="text-center">
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

                @foreach ($misiAsingAsean->audiensi as $item)
                    <div class="modal modal-blur fade" id="modal-audiensi-{{ $item->id_audiensi }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Rincian Audiensi - {{ $misiAsingAsean->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $misiAsingAsean->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $misiAsingAsean->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->nama_resmi_mitra ?? '-' }}</div>
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
                                            <div class="datagrid-content">{{ $item->status_audiensi }}</div>
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
                <p class="text-danger mb-0">Belum ada riwayat audiensi untuk misi ini.</p>
            @endif
        </div>

        {{-- Kunjungan --}}
        <div class="tab-pane" id="tab-kunjungan" role="tabpanel">
            @if ($misiAsingAsean->kunjungan->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%" class="text-start">Perihal</th>
                                <th style="width: 12%" class="text-start">Tanggal Diterima</th>
                                <th style="width: 12%" class="text-start">Tanggal Selesai</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($misiAsingAsean->kunjungan as $item)
                                <tr>
                                    <td class="text-start">{{ str($item->perihal)->stripTags() }}</td>
                                    <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td class="text-center">{{ $item->status_kunjungan }}</td>
                                    <td class="text-center">
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

                @foreach ($misiAsingAsean->kunjungan as $item)
                    <div class="modal modal-blur fade" id="modal-kunjungan-{{ $item->id_kunjungan }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Rincian Kunjungan - {{ $misiAsingAsean->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $misiAsingAsean->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $misiAsingAsean->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->nama_resmi_mitra ?? '-' }}</div>
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
                                            <div class="datagrid-content">{{ $item->status_kunjungan }}</div>
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
                <p class="text-danger mb-0">Belum ada riwayat kunjungan untuk misi ini.</p>
            @endif
        </div>

        {{-- Acara DKI --}}
        <div class="tab-pane" id="tab-acara-dki" role="tabpanel">
            @if ($misiAsingAsean->acaraDki->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 25%" class="text-start">Acara DKI</th>
                                <th style="width: 10%" class="text-start">Tanggal Diterima</th>
                                <th style="width: 10%" class="text-start">Tanggal Selesai</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 12%" class="text-center">Status Kehadiran</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($misiAsingAsean->acaraDki as $item)
                                <tr>
                                    <td class="text-start">{{ str($item->acara_dki)->stripTags() }}</td>
                                    <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                    <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                    <td class="text-center">{{ $item->status_acara_dki }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ match ($item->pivot->status_kehadiran) {
                                            'Hadir' => 'bg-success-lt',
                                            'Tidak Hadir' => 'bg-danger-lt',
                                            default => 'bg-blue-lt',
                                        } }}">
                                            {{ $item->pivot->status_kehadiran }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('acara-dki.edit', $item->id_acara_dki) }}" class="btn btn-icon btn-warning">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal-acara-dki-{{ $item->id_acara_dki }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach ($misiAsingAsean->acaraDki as $item)
                    <div class="modal modal-blur fade" id="modal-acara-dki-{{ $item->id_acara_dki }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Rincian Acara DKI - {{ $misiAsingAsean->mitra->nama_mitra }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="hr-text hr-text-start">Mitra</div>
                                    <div class="datagrid align-items-center mb-3">
                                        <div class="datagrid-item">
                                            <div class="datagrid-content d-flex align-items-center">
                                                <span class="flag flag-md flag-country-{{ $misiAsingAsean->mitra->kode_mitra }} me-2"></span>
                                                <span class="fw-bold">{{ $misiAsingAsean->mitra->nama_mitra }}</span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tipe Mitra</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->tipe_mitra->value }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Nama Resmi</div>
                                            <div class="datagrid-content">{{ $misiAsingAsean->mitra->nama_resmi_mitra ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Acara DKI</div>
                                    <div class="mb-3">
                                        <div class="border rounded p-3">
                                            @if ($item->acara_dki)
                                                {!! $item->acara_dki !!}
                                            @else
                                                <p class="text-secondary mb-0">Belum ada catatan acara DKI.</p>
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

                                    <div class="hr-text hr-text-start">Pelaksana</div>
                                    <div class="mb-3">{{ $item->pelaksana ?? '-' }}</div>

                                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                                    <div class="datagrid align-items-center mb-3">
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
                                            <div class="datagrid-content">{{ $item->triwulan_acara_dki }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status Acara DKI</div>
                                            <div class="datagrid-content">{{ $item->status_acara_dki }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Status Kehadiran</div>
                                            <div class="datagrid-content">{{ $item->pivot->status_kehadiran }}</div>
                                        </div>
                                    </div>

                                    <div class="hr-text hr-text-start">Tanggal Pelaksanaan</div>
                                    <div class="datagrid align-items-center">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Awal Pelaksanaan</div>
                                            <div class="datagrid-content">{{ $item->tanggal_awal_pelaksanaan?->format('d M Y') ?? '-' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Tanggal Akhir Pelaksanaan</div>
                                            <div class="datagrid-content">{{ $item->tanggal_akhir_pelaksanaan?->format('d M Y') ?? '-' }}</div>
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
                <p class="text-danger mb-0">Belum ada riwayat acara DKI untuk misi ini.</p>
            @endif
        </div>

    </div>
    {{-- tab-content --}}
</div>
