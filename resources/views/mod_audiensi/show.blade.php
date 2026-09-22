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
                    <h3 class="card-title">Rincian Audiensi - {{ $audiensi->mitra->label_mitra }}</h3>
                </div>
                <div class="card-body">

                    {{-- id_mitra --}}
                    <div class="hr-text hr-text-start">Mitra</div>
                    <div class="datagrid align-items-center mb-3">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <x-mitra-icon :mitra="$audiensi->mitra" />
                                <span class="fw-bold">{{ $audiensi->mitra->label_mitra }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tipe Mitra</div>
                            <div class="datagrid-content">{{ $audiensi->mitra->tipe_mitra->value }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Resmi</div>
                            <div class="datagrid-content">{{ $audiensi->mitra->nama_resmi_mitra ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- id_mitra --}}

                    {{-- topik --}}
                    <div class="hr-text hr-text-start">Topik</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            @if ($audiensi->topik)
                                {!! $audiensi->topik !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan topik.</p>
                            @endif
                        </div>
                    </div>
                    {{-- topik --}}

                    {{-- rangkuman --}}
                    <div class="hr-text hr-text-start">Rangkuman</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $audiensi->rangkuman !!}
                        </div>
                    </div>
                    {{-- rangkuman --}}

                    {{-- catatan --}}
                    <div class="hr-text hr-text-start">Catatan</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $audiensi->catatan !!}
                        </div>
                    </div>
                    {{-- catatan --}}

                    {{-- tanggal_diterima, tanggal_selesai, triwulan_audiensi, status_audiensi --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $audiensi->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $audiensi->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $audiensi->triwulan_audiensi }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Audiensi</div>
                            <div class="datagrid-content">
                                <span class="badge {{ $audiensi->status_badge_color }}">
                                    {{ $audiensi->status_audiensi }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- tanggal_diterima, tanggal_selesai, triwulan_audiensi, status_audiensi --}}

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
