@extends('template.app')

{{-- content --}}
@section('nav-audiensi', 'active')
@section('page-header')
    <x-page-header
        title="Modul Audiensi"
        back-route="audiensi.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Audiensi - {{ $audiensi->kedutaanBesar->nama_negara }}</h3>
                </div>
                <div class="card-body">

                    {{-- kedutaan besar --}}
                    <div class="hr-text hr-text-start">Kedutaan Besar</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <span class="flag flag-md flag-country-{{ $audiensi->kedutaanBesar->kode_negara }} me-2"></span>
                                <span class="fw-bold">{{ $audiensi->kedutaanBesar->nama_negara }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (ID)</div>
                            <div class="datagrid-content">{{ $audiensi->kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (EN)</div>
                            <div class="datagrid-content">{{ $audiensi->kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Diplomat</div>
                            <div class="datagrid-content">{{ $audiensi->kedutaanBesar->nama_diplomat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Jabatan Diplomat</div>
                            <div class="datagrid-content">{{ $audiensi->kedutaanBesar->jabatan_diplomat ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- kedutaan besar --}}

                    {{-- status & jadwal --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $audiensi->triwulan_audiensi }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $audiensi->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $audiensi->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Audiensi</div>
                            <div class="datagrid-content">{{ $audiensi->status_audiensi }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title"></div>
                            <div class="datagrid-content"></div>
                        </div>
                    </div>
                    {{-- status & jadwal --}}

                    {{-- detail audiensi --}}
                    <div class="hr-text hr-text-start">Detail Audiensi</div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Topik</div>
                        <div class="border rounded p-3">
                            @if ($audiensi->topik)
                                {!! $audiensi->topik !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan topik.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Rangkuman</div>
                        <div class="border rounded p-3">
                            {!! $audiensi->rangkuman !!}
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="text-secondary mb-2">Catatan</div>
                        <div class="border rounded p-3">
                            {!! $audiensi->catatan !!}
                        </div>
                    </div>
                    {{-- detail audiensi --}}

                </div>
                <div class="card-footer">
                    <small class="text-danger">Diakses pada {{ now()->format('d M Y, H:i') }} WIB</small>
                </div>
                {{-- card-footer --}}
            </div>
            {{-- card --}}
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

@endsection
