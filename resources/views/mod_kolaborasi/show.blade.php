@extends('template.app')

{{-- content --}}
@section('nav-kolaborasi', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kolaborasi"
        back-route="kolaborasi.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Kolaborasi - {{ $kolaborasi->mitra->label_mitra }}</h3>
                </div>
                <div class="card-body">

                    {{-- id_mitra --}}
                    <div class="hr-text hr-text-start">Mitra</div>
                    <div class="datagrid align-items-center mb-3">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <x-mitra-icon :mitra="$kolaborasi->mitra" />
                                <span class="fw-bold">{{ $kolaborasi->mitra->label_mitra }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tipe Mitra</div>
                            <div class="datagrid-content">{{ $kolaborasi->mitra->tipe_mitra->value }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Resmi</div>
                            <div class="datagrid-content">{{ $kolaborasi->mitra->nama_resmi_mitra ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- id_mitra --}}

                    {{-- kolaborasi --}}
                    <div class="hr-text hr-text-start">Isi Kolaborasi</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            @if ($kolaborasi->kolaborasi)
                                {!! $kolaborasi->kolaborasi !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan kolaborasi.</p>
                            @endif
                        </div>
                    </div>
                    {{-- kolaborasi --}}

                    {{-- rangkuman --}}
                    <div class="hr-text hr-text-start">Rangkuman</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $kolaborasi->rangkuman !!}
                        </div>
                    </div>
                    {{-- rangkuman --}}

                    {{-- catatan --}}
                    <div class="hr-text hr-text-start">Catatan</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $kolaborasi->catatan !!}
                        </div>
                    </div>
                    {{-- catatan --}}

                    {{-- tanggal_diterima, tanggal_selesai, triwulan_kolaborasi, status_kolaborasi --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $kolaborasi->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $kolaborasi->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $kolaborasi->triwulan_kolaborasi }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Kolaborasi</div>
                            <div class="datagrid-content">
                                <span class="badge {{ $kolaborasi->status_badge_color }}">
                                    {{ $kolaborasi->status_kolaborasi }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- tanggal_diterima, tanggal_selesai, triwulan_kolaborasi, status_kolaborasi --}}

                </div>
                <div class="card-footer">
                    <small class="text-danger"><x-waktu-akses /></small>
                </div>
                {{-- card-footer --}}
            </div>
            {{-- card --}}
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

@endsection
