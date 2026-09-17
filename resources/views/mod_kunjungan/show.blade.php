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
                    <h3 class="card-title">Rincian Kunjungan - {{ $kunjungan->mitra->nama_mitra }}</h3>
                </div>
                <div class="card-body">

                    {{-- id_mitra --}}
                    <div class="hr-text hr-text-start">Mitra</div>
                    <div class="datagrid align-items-center mb-3">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <span class="flag flag-md flag-country-{{ $kunjungan->mitra->kode_mitra }} me-2"></span>
                                <span class="fw-bold">{{ $kunjungan->mitra->nama_mitra }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tipe Mitra</div>
                            <div class="datagrid-content">{{ $kunjungan->mitra->tipe_mitra->value }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Resmi</div>
                            <div class="datagrid-content">{{ $kunjungan->mitra->nama_resmi_mitra ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- id_mitra --}}

                    {{-- perihal --}}
                    <div class="hr-text hr-text-start">Perihal</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            @if ($kunjungan->perihal)
                                {!! $kunjungan->perihal !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan perihal.</p>
                            @endif
                        </div>
                    </div>
                    {{-- perihal --}}

                    {{-- rangkuman --}}
                    <div class="hr-text hr-text-start">Rangkuman</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $kunjungan->rangkuman !!}
                        </div>
                    </div>
                    {{-- rangkuman --}}

                    {{-- catatan --}}
                    <div class="hr-text hr-text-start">Catatan</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $kunjungan->catatan !!}
                        </div>
                    </div>
                    {{-- catatan --}}

                    {{-- tanggal_diterima, tanggal_selesai, triwulan_kunjungan, status_kunjungan --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $kunjungan->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $kunjungan->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $kunjungan->triwulan_kunjungan }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Kunjungan</div>
                            <div class="datagrid-content">
                                <span class="badge {{ $kunjungan->status_badge_color }}">
                                    {{ $kunjungan->status_kunjungan }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- tanggal_diterima, tanggal_selesai, triwulan_kunjungan, status_kunjungan --}}

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
