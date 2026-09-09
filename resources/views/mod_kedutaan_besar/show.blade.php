@extends('template.app')

{{-- content --}}
@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kedutaan Besar"
        back-route="kedutaan-besar.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <x-page-body-show title="Rincian Data - {{ $kedutaanBesar->nama_negara }}">
        @include('mod_kedutaan_besar.show-rincian-data')
    </x-page-body-show>

    <x-page-body-show title="Riwayat Diplomasi">
        <x-slot:header-right>
            <span class="flag flag-md flag-country-{{ $kedutaanBesar->kode_negara }} me-2"></span>
            <span class="fw-bold">{{ $kedutaanBesar->nama_negara }}</span>
        </x-slot:header-right>

        @include('mod_kedutaan_besar.show-riwayat-diplomasi')
    </x-page-body-show>
@endsection
