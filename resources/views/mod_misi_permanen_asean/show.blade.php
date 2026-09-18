@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Permanen Negara ASEAN" back-route="misi-permanen-asean.index" />
@endsection

@section('page-content')
    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <x-page-body-show title="Rincian Data">
                @include('mod_misi_permanen_asean.show-rincian')
            </x-page-body-show>
        </div>
        <div class="col-lg-12">
            <x-page-body-show title="Riwayat Diplomasi">
                @include('mod_misi_permanen_asean.show-riwayat')
            </x-page-body-show>
        </div>

        {{-- <div class="col-lg-4">
            <x-page-body-show title="Lokasi di Peta">
                @include('mod_misi_permanen_asean.show-peta')
            </x-page-body-show>
        </div> --}}
    </div>
@endsection
