@extends('template.app')

{{-- content --}}
@section('nav-undangan', 'active')
@section('page-header')
    <x-page-header
        title="Modul Undangan"
        back-route="undangan.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Undangan - {{ $undangan->mitra->label_mitra }}</h3>
                </div>
                <div class="card-body">

                    {{-- id_mitra --}}
                    <div class="hr-text hr-text-start">Mitra</div>
                    <div class="datagrid align-items-center mb-3">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <x-mitra-icon :mitra="$undangan->mitra" />
                                <span class="fw-bold">{{ $undangan->mitra->label_mitra }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tipe Mitra</div>
                            <div class="datagrid-content">{{ $undangan->mitra->tipe_mitra->value }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Resmi</div>
                            <div class="datagrid-content">{{ $undangan->mitra->nama_resmi_mitra ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- id_mitra --}}

                    {{-- acara --}}
                    <div class="hr-text hr-text-start">Acara</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            @if ($undangan->acara)
                                {!! $undangan->acara !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan acara.</p>
                            @endif
                        </div>
                    </div>
                    {{-- acara --}}

                    {{-- rangkuman --}}
                    <div class="hr-text hr-text-start">Rangkuman</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $undangan->rangkuman !!}
                        </div>
                    </div>
                    {{-- rangkuman --}}

                    {{-- catatan --}}
                    <div class="hr-text hr-text-start">Catatan</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $undangan->catatan !!}
                        </div>
                    </div>
                    {{-- catatan --}}

                    {{-- tanggal_diterima, tanggal_selesai, triwulan_undangan, status_undangan --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $undangan->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $undangan->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $undangan->triwulan_undangan }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Undangan</div>
                            <div class="datagrid-content">
                                <span class="badge {{ $undangan->status_badge_color }}">
                                    {{ $undangan->status_undangan }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- tanggal_diterima, tanggal_selesai, triwulan_undangan, status_undangan --}}

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
