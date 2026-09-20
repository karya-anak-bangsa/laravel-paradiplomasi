@extends('template.app')

{{-- content --}}
@section('nav-acara-dki', 'active')
@section('page-header')
    <x-page-header
        title="Modul Acara DKI"
        back-route="acara-dki.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Acara DKI - {{ $acaraDki->judul_ringkas }}</h3>
                </div>
                <div class="card-body">

                    {{-- acara_dki --}}
                    <div class="hr-text hr-text-start">Acara DKI</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            @if ($acaraDki->acara_dki)
                                {!! $acaraDki->acara_dki !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan acara DKI.</p>
                            @endif
                        </div>
                    </div>
                    {{-- acara_dki --}}

                    {{-- rangkuman --}}
                    <div class="hr-text hr-text-start">Rangkuman</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $acaraDki->rangkuman !!}
                        </div>
                    </div>
                    {{-- rangkuman --}}

                    {{-- catatan --}}
                    <div class="hr-text hr-text-start">Catatan</div>
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            {!! $acaraDki->catatan !!}
                        </div>
                    </div>
                    {{-- catatan --}}

                    {{-- tanggal_diterima, tanggal_selesai, triwulan_acara_dki, status_acara_dki --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center mb-3">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $acaraDki->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $acaraDki->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $acaraDki->triwulan_acara_dki }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Acara DKI</div>
                            <div class="datagrid-content">
                                <span class="badge {{ $acaraDki->status_badge_color }}">
                                    {{ $acaraDki->status_acara_dki }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- tanggal_diterima, tanggal_selesai, triwulan_acara_dki, status_acara_dki --}}

                    {{-- tanggal_awal_pelaksanaan, tanggal_akhir_pelaksanaan --}}
                    <div class="hr-text hr-text-start">Tanggal Pelaksanaan</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Awal Pelaksanaan</div>
                            <div class="datagrid-content">{{ $acaraDki->tanggal_awal_pelaksanaan?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Akhir Pelaksanaan</div>
                            <div class="datagrid-content">{{ $acaraDki->tanggal_akhir_pelaksanaan?->format('d M Y') ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- tanggal_awal_pelaksanaan, tanggal_akhir_pelaksanaan --}}

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
