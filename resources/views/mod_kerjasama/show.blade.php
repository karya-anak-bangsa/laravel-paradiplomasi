@extends('template.app')

{{-- content --}}
@section('nav-kerjasama', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kerjasama"
        back-route="kerjasama.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Kerjasama - {{ $kerjasama->mitra->nama_mitra ?? $kerjasama->mitra->nama_resmi_mitra }}</h3>
                </div>
                <div class="card-body">

                    {{-- id_mitra --}}
                    <div class="hr-text hr-text-start">Mitra</div>
                    <div class="datagrid align-items-center mb-3">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <x-mitra-icon :mitra="$kerjasama->mitra" />
                                <span class="fw-bold">{{ $kerjasama->mitra->nama_mitra ?? $kerjasama->mitra->nama_resmi_mitra }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tipe Mitra</div>
                            <div class="datagrid-content">{{ $kerjasama->mitra->tipe_mitra->value }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Resmi</div>
                            <div class="datagrid-content">{{ $kerjasama->mitra->nama_resmi_mitra ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- id_mitra --}}

                    {{-- kerjasama --}}
                    <div class="hr-text hr-text-start">Kerjasama</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            @if ($kerjasama->kerjasama)
                                {!! $kerjasama->kerjasama !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan kerjasama.</p>
                            @endif
                        </div>
                    </div>
                    {{-- kerjasama --}}

                    {{-- rangkuman --}}
                    <div class="hr-text hr-text-start">Rangkuman</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $kerjasama->rangkuman !!}
                        </div>
                    </div>
                    {{-- rangkuman --}}

                    {{-- catatan --}}
                    <div class="hr-text hr-text-start">Catatan</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $kerjasama->catatan !!}
                        </div>
                    </div>
                    {{-- catatan --}}

                    {{-- tanggal_diterima, tanggal_selesai, triwulan_kerjasama, status_kerjasama --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $kerjasama->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $kerjasama->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $kerjasama->triwulan_kerjasama }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Kerjasama</div>
                            <div class="datagrid-content">
                                <span class="badge {{ $kerjasama->status_badge_color }}">
                                    {{ $kerjasama->status_kerjasama }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- tanggal_diterima, tanggal_selesai, triwulan_kerjasama, status_kerjasama --}}

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
