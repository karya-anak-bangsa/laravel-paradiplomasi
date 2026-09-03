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
                    <h3 class="card-title">Rincian Kolaborasi - {{ $kolaborasi->kedutaanBesar->nama_negara }}</h3>
                </div>
                <div class="card-body">

                    {{-- kedutaan besar --}}
                    <div class="hr-text hr-text-start">Kedutaan Besar</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <span class="flag flag-md flag-country-{{ $kolaborasi->kedutaanBesar->kode_negara }} me-2"></span>
                                <span class="fw-bold">{{ $kolaborasi->kedutaanBesar->nama_negara }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (ID)</div>
                            <div class="datagrid-content">{{ $kolaborasi->kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (EN)</div>
                            <div class="datagrid-content">{{ $kolaborasi->kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Diplomat</div>
                            <div class="datagrid-content">{{ $kolaborasi->kedutaanBesar->nama_diplomat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Jabatan Diplomat</div>
                            <div class="datagrid-content">{{ $kolaborasi->kedutaanBesar->jabatan_diplomat ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- kedutaan besar --}}

                    {{-- status & jadwal --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $kolaborasi->triwulan_kolaborasi }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $kolaborasi->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $kolaborasi->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">File Dokumen</div>
                            <div class="datagrid-content">
                                <a href="#" class="text-blue"><i class="fa-solid fa-download me-1"></i>Unduh</a>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Kolaborasi</div>
                            <div class="datagrid-content">
                                <div class="datagrid-content">{{ $kolaborasi->status_kolaborasi }}</div>
                            </div>
                        </div>
                    </div>
                    {{-- status & jadwal --}}

                    {{-- detail kolaborasi --}}
                    <div class="hr-text hr-text-start">Detail Kolaborasi</div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Isi Kolaborasi</div>
                        <div class="border rounded p-3">
                            @if ($kolaborasi->kolaborasi)
                                {!! $kolaborasi->kolaborasi !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan kolaborasi.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Rangkuman</div>
                        <div class="border rounded p-3">
                            {!! $kolaborasi->rangkuman !!}
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="text-secondary mb-2">Catatan</div>
                        <div class="border rounded p-3">
                            {!! $kolaborasi->catatan !!}
                        </div>
                    </div>
                    {{-- detail kolaborasi --}}

                    {{-- kontak pic --}}
                    <div class="hr-text hr-text-start">Kontak PIC</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama PIC</div>
                            <div class="datagrid-content">{{ $kolaborasi->nama_pic ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nomor PIC</div>
                            <div class="datagrid-content">{{ $kolaborasi->nomor_pic ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- kontak pic --}}

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
