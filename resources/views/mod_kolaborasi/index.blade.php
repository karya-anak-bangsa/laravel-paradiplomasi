@extends('template.app')

@section('nav-kolaborasi', 'active')
@section('page-header')
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">Data Kolaborasi</h1>
            <span class="text-secondary">Daftar kolaborasi dengan perwakilan negara asing</span>
        </div>
    </div>
@endsection

@section('page-content')

    <div class="card">
        <div class="card-table">

            {{-- card-header + search box --}}
            <div class="card-header">
                <div class="row w-full">
                    <div class="col">
                        <a href="" class="btn btn-success">Tambah Data</a>
                    </div>
                    <div class="col-md-auto col-sm-12">
                        <div class="ms-auto d-flex flex-wrap btn-list">
                            <div class="input-group input-group-flat w-auto">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                </span>
                                <input id="kolaborasi-table-search" type="text" class="form-control" autocomplete="off" placeholder="Cari...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- table body --}}
            <div id="kolaborasi-table">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th><button class="table-sort d-flex justify-content-between" data-sort="sort-negara">Negara</button></th>
                                <th><button class="table-sort d-flex justify-content-between" data-sort="sort-bentuk">Bentuk Kolaborasi</button></th>
                                <th><button class="table-sort d-flex justify-content-between" data-sort="sort-triwulan">Triwulan</button></th>
                                <th><button class="table-sort d-flex justify-content-between" data-sort="sort-tanggal">Tanggal Diterima</button></th>
                                <th>PIC</th>
                                <th><button class="table-sort d-flex justify-content-between" data-sort="sort-status">Status</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @forelse ($kolaborasi as $item)
                                <tr>
                                    <td class="sort-negara">
                                        <div class="d-flex align-items-center">
                                            <span class="flag flag-sm flag-country-{{ $item->kedutaanBesar->kode_negara }} me-2"></span>
                                            {{ $item->kedutaanBesar->nama_negara }}
                                        </div>
                                    </td>
                                    <td class="sort-bentuk">
                                        {{ Str::limit($item->kolaborasi, 60) }}
                                    </td>
                                    <td class="sort-triwulan">
                                        {{ $item->triwulan_kolaborasi ?? '-' }}
                                    </td>
                                    <td class="sort-tanggal">
                                        {{ $item->tanggal_diterima?->format('d M Y') ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $item->nama_pic ?? '-' }}
                                        @if ($item->nomor_pic)
                                            <div class="text-secondary small">{{ $item->nomor_pic }}</div>
                                        @endif
                                    </td>
                                    <td class="sort-status">
                                        @php
                                            $badgeClass = match ($item->status_kolaborasi) {
                                                'Berjalan' => 'bg-blue-lt',
                                                'Selesai' => 'bg-success-lt',
                                                'Batal' => 'bg-danger-lt',
                                                default => 'bg-secondary-lt',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $item->status_kolaborasi }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-secondary py-4">Belum ada data kolaborasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- footer: page-size dropdown + pagination, ditangani List.js --}}
                <div class="card-footer d-flex align-items-center">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <span id="kolaborasi-page-count" class="me-1">10</span> <span>records</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="setKolaborasiPageSize(event)" data-value="10">10 records</a>
                            <a class="dropdown-item" onclick="setKolaborasiPageSize(event)" data-value="25">25 records</a>
                            <a class="dropdown-item" onclick="setKolaborasiPageSize(event)" data-value="50">50 records</a>
                        </div>
                    </div>
                    <ul class="pagination m-0 ms-auto"></ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const setKolaborasiPageSize = (e) => {
                window.tabler_list['kolaborasi-table'].page = parseInt(e.target.dataset.value);
                window.tabler_list['kolaborasi-table'].update();
                document.querySelector('#kolaborasi-page-count').innerHTML = e.target.dataset.value;
            };
            window.tabler_list = window.tabler_list || {};
            document.addEventListener('DOMContentLoaded', function() {
                const list = window.tabler_list['kolaborasi-table'] = new List('kolaborasi-table', {
                    sortClass: 'table-sort',
                    listClass: 'table-tbody',
                    page: 10,
                    pagination: {
                        item: (value) => `<li class="page-item"><a class="page-link cursor-pointer">${value.page}</a></li>`,
                        innerWindow: 1,
                        outerWindow: 1,
                        left: 0,
                        right: 0,
                    },
                    valueNames: ['sort-negara', 'sort-bentuk', 'sort-triwulan', 'sort-tanggal', 'sort-status'],
                });
                const searchInput = document.querySelector('#kolaborasi-table-search');
                searchInput.addEventListener('input', () => list.search(searchInput.value));
            });
        </script>
    @endpush

@endsection
