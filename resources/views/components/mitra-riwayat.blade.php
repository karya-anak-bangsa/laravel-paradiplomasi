@props([
    'mitra',
    'sebutan' => 'mitra',
])

{{--
    Tab Riwayat Diplomasi pada halaman profil mitra — dipakai bersama oleh SELURUH
    modul mitra (Kedutaan Besar, Misi Asing ASEAN, Misi Permanen ASEAN, Non-PNA,
    Pemprov DKI, KBRI, KJRI, PTRI).

    Sebelumnya tiap modul mitra punya salinan show-riwayat.blade.php sendiri
    sepanjang ±800 baris yang isinya identik kecuali nama variabel — melanggar
    CLAUDE.md Bagian 9.5. Komponen ini menggantikan seluruh salinan tersebut.

    Prop:
      $mitra   — model subtype (KedutaanBesar/Kbri/dst) yang keenam relasi
                 Riwayat Diplomasi-nya sudah di-load oleh controller.
      $sebutan — kata benda untuk pesan kosong, mis. "kedutaan ini" / "misi ini".

    Lima modul pertama (Kerjasama-Kunjungan) proses bisnisnya identik sehingga
    dirender dari satu konfigurasi. Acara DKI dirender terpisah karena relasinya
    many-to-many dan membawa kolom pivot status_kehadiran (lihat CLAUDE.md
    Bagian 4).
--}}

@php
    $daftarModul = [
        [
            'relasi' => 'kerjasama',
            'label' => 'Kerjasama',
            'judulLabel' => 'Kerjasama',
            'judulKolom' => 'kerjasama',
            'route' => 'kerjasama',
            'pk' => 'id_kerjasama',
            'statusKolom' => 'status_kerjasama',
            'triwulanKolom' => 'triwulan_kerjasama',
        ],
        [
            'relasi' => 'kolaborasi',
            'label' => 'Kolaborasi',
            'judulLabel' => 'Kolaborasi',
            'judulKolom' => 'kolaborasi',
            'route' => 'kolaborasi',
            'pk' => 'id_kolaborasi',
            'statusKolom' => 'status_kolaborasi',
            'triwulanKolom' => 'triwulan_kolaborasi',
        ],
        [
            'relasi' => 'undangan',
            'label' => 'Undangan',
            'judulLabel' => 'Acara',
            'judulKolom' => 'acara',
            'route' => 'undangan',
            'pk' => 'id_undangan',
            'statusKolom' => 'status_undangan',
            'triwulanKolom' => 'triwulan_undangan',
        ],
        [
            'relasi' => 'audiensi',
            'label' => 'Audiensi',
            'judulLabel' => 'Topik',
            'judulKolom' => 'topik',
            'route' => 'audiensi',
            'pk' => 'id_audiensi',
            'statusKolom' => 'status_audiensi',
            'triwulanKolom' => 'triwulan_audiensi',
        ],
        [
            'relasi' => 'kunjungan',
            'label' => 'Kunjungan',
            'judulLabel' => 'Perihal',
            'judulKolom' => 'perihal',
            'route' => 'kunjungan',
            'pk' => 'id_kunjungan',
            'statusKolom' => 'status_kunjungan',
            'triwulanKolom' => 'triwulan_kunjungan',
        ],
    ];

    $induk = $mitra->mitra;
    $namaTampil = $induk->label_mitra;
@endphp

<div class="mb-0">
    <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
        @foreach ($daftarModul as $i => $modul)
            <li class="nav-item" role="presentation">
                <a href="#tab-{{ $modul['relasi'] }}" class="nav-link @if ($i === 0) active @endif"
                    data-bs-toggle="tab" role="tab">{{ $modul['label'] }}</a>
            </li>
        @endforeach
        <li class="nav-item" role="presentation">
            <a href="#tab-acara-dki" class="nav-link" data-bs-toggle="tab" role="tab">Acara DKI</a>
        </li>
    </ul>

    <div class="tab-content my-3">

        {{-- Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan --}}
        @foreach ($daftarModul as $i => $modul)
            <div class="tab-pane @if ($i === 0) active show @endif" id="tab-{{ $modul['relasi'] }}" role="tabpanel">
                @php $daftarItem = $mitra->{$modul['relasi']}; @endphp

                @if ($daftarItem->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 30%" class="text-start">{{ $modul['label'] }}</th>
                                    <th style="width: 12%" class="text-start">Tanggal Diterima</th>
                                    <th style="width: 12%" class="text-start">Tanggal Selesai</th>
                                    <th style="width: 10%" class="text-center">Status</th>
                                    <th style="width: 15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarItem as $item)
                                    <tr>
                                        <td class="text-start">{{ str($item->{$modul['judulKolom']})->stripTags() }}</td>
                                        <td class="text-start">{{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}</td>
                                        <td class="text-start">{{ $item->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</td>
                                        <td class="text-center">{{ $item->{$modul['statusKolom']} }}</td>
                                        <td class="text-center">
                                            <a href="{{ route($modul['route'] . '.edit', $item->{$modul['pk']}) }}" class="btn btn-icon btn-warning">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-icon btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#modal-{{ $modul['relasi'] }}-{{ $item->{$modul['pk']} }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach ($daftarItem as $item)
                        <div class="modal modal-blur fade" id="modal-{{ $modul['relasi'] }}-{{ $item->{$modul['pk']} }}"
                            tabindex="-1" role="dialog" aria-hidden="true"
                            data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Rincian {{ $modul['label'] }} - {{ $namaTampil }}</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <x-mitra-ringkas :mitra="$induk" />

                                        <div class="hr-text hr-text-start">{{ $modul['judulLabel'] }}</div>
                                        <div class="mb-3">
                                            <div class="border rounded p-3">
                                                @if ($item->{$modul['judulKolom']})
                                                    {!! $item->{$modul['judulKolom']} !!}
                                                @else
                                                    <p class="text-secondary mb-0">Belum ada catatan {{ strtolower($modul['judulLabel']) }}.</p>
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
                                                <div class="datagrid-content">{{ $item->{$modul['triwulanKolom']} }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Status {{ $modul['label'] }}</div>
                                                <div class="datagrid-content">{{ $item->{$modul['statusKolom']} }}</div>
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
                    <p class="text-danger mb-0">Belum ada riwayat {{ strtolower($modul['label']) }} untuk {{ $sebutan }}.</p>
                @endif
            </div>
        @endforeach

        {{-- Acara DKI — relasi many-to-many, membawa kolom pivot status_kehadiran --}}
        <div class="tab-pane" id="tab-acara-dki" role="tabpanel">
            @if ($mitra->acaraDki->isNotEmpty())
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
                            @foreach ($mitra->acaraDki as $item)
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

                @foreach ($mitra->acaraDki as $item)
                    <div class="modal modal-blur fade" id="modal-acara-dki-{{ $item->id_acara_dki }}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Rincian Acara DKI - {{ $namaTampil }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <x-mitra-ringkas :mitra="$induk" />

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
                <p class="text-danger mb-0">Belum ada riwayat acara DKI untuk {{ $sebutan }}.</p>
            @endif
        </div>

    </div>
    {{-- tab-content --}}
</div>
