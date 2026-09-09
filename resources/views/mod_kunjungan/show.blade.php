@extends('template.app')

{{-- content --}}
@section('nav-kunjungan', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kunjungan"
        back-route="kunjungan.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Kunjungan - {{ $kunjungan->kedutaanBesar->nama_negara }}</h3>
                </div>
                <div class="card-body">

                    {{-- kedutaan besar --}}
                    <div class="hr-text hr-text-start">Kedutaan Besar</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <span class="flag flag-md flag-country-{{ $kunjungan->kedutaanBesar->kode_negara }} me-2"></span>
                                <span class="fw-bold">{{ $kunjungan->kedutaanBesar->nama_negara }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (ID)</div>
                            <div class="datagrid-content">{{ $kunjungan->kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (EN)</div>
                            <div class="datagrid-content">{{ $kunjungan->kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Diplomat</div>
                            <div class="datagrid-content">{{ $kunjungan->kedutaanBesar->nama_diplomat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Jabatan Diplomat</div>
                            <div class="datagrid-content">{{ $kunjungan->kedutaanBesar->jabatan_diplomat ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- kedutaan besar --}}

                    {{-- status & jadwal --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $kunjungan->triwulan_kunjungan }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $kunjungan->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $kunjungan->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Kunjungan</div>
                            <div class="datagrid-content">{{ $kunjungan->status_kunjungan }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title"></div>
                            <div class="datagrid-content"></div>
                        </div>
                    </div>
                    {{-- status & jadwal --}}

                    {{-- detail kunjungan --}}
                    <div class="hr-text hr-text-start">Detail Kunjungan</div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Perihal</div>
                        <div class="border rounded p-3">
                            @if ($kunjungan->perihal)
                                {!! $kunjungan->perihal !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan perihal.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Rangkuman</div>
                        <div class="border rounded p-3">
                            {!! $kunjungan->rangkuman !!}
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="text-secondary mb-2">Catatan</div>
                        <div class="border rounded p-3">
                            {!! $kunjungan->catatan !!}
                        </div>
                    </div>
                    {{-- detail kunjungan --}}

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
