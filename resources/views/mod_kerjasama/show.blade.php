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
                    <h3 class="card-title">Rincian Kerjasama - {{ $kerjasama->kedutaanBesar->nama_negara }}</h3>
                </div>
                <div class="card-body">

                    {{-- kedutaan besar --}}
                    <div class="hr-text hr-text-start">Kedutaan Besar</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-content d-flex align-items-center">
                                <span class="flag flag-md flag-country-{{ $kerjasama->kedutaanBesar->kode_negara }} me-2"></span>
                                <span class="fw-bold">{{ $kerjasama->kedutaanBesar->nama_negara }}</span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (ID)</div>
                            <div class="datagrid-content">{{ $kerjasama->kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (EN)</div>
                            <div class="datagrid-content">{{ $kerjasama->kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Diplomat</div>
                            <div class="datagrid-content">{{ $kerjasama->kedutaanBesar->nama_diplomat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Jabatan Diplomat</div>
                            <div class="datagrid-content">{{ $kerjasama->kedutaanBesar->jabatan_diplomat ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- kedutaan besar --}}

                    {{-- status & jadwal --}}
                    <div class="hr-text hr-text-start">Status & Jadwal</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Triwulan</div>
                            <div class="datagrid-content">{{ $kerjasama->triwulan_kerjasama }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Diterima</div>
                            <div class="datagrid-content">{{ $kerjasama->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Tanggal Selesai</div>
                            <div class="datagrid-content">{{ $kerjasama->tanggal_selesai?->format('d M Y') ?? 'Masih berjalan' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">File Dokumen</div>
                            <div class="datagrid-content">
                                <a href="#" class="text-blue"><i class="fa-solid fa-download me-1"></i>Unduh</a>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Status Kerjasama</div>
                            <div class="datagrid-content">{{ $kerjasama->status_kerjasama }}</div>
                        </div>
                    </div>
                    {{-- status & jadwal --}}

                    {{-- detail kerjasama --}}
                    <div class="hr-text hr-text-start">Detail Kerjasama</div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Isi Kerjasama</div>
                        <div class="border rounded p-3">
                            @if ($kerjasama->kerjasama)
                                {!! $kerjasama->kerjasama !!}
                            @else
                                <p class="text-secondary mb-0">Belum ada catatan kerjasama.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="text-secondary mb-2">Rangkuman</div>
                        <div class="border rounded p-3">
                            {!! $kerjasama->rangkuman !!}
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="text-secondary mb-2">Catatan</div>
                        <div class="border rounded p-3">
                            {!! $kerjasama->catatan !!}
                        </div>
                    </div>
                    {{-- detail kerjasama --}}

                    {{-- pic & dokumen --}}
                    <div class="hr-text hr-text-start">Kontak PIC</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama PIC</div>
                            <div class="datagrid-content">{{ $kerjasama->nama_pic ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nomor PIC</div>
                            <div class="datagrid-content">{{ $kerjasama->nomor_pic ?? '-' }}</div>
                        </div>
                    </div>
                    {{-- pic & dokumen --}}

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
