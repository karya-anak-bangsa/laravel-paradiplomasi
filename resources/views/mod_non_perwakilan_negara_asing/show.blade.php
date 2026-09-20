@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Non Perwakilan Negara Asing" back-route="non-perwakilan-negara-asing.index" />
@endsection

@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">

            <x-page-body-show title="Rincian Data">
                @include('mod_non_perwakilan_negara_asing.show-rincian')
            </x-page-body-show>

            <x-page-body-show title="Riwayat Diplomasi">
                @include('mod_non_perwakilan_negara_asing.show-riwayat')
            </x-page-body-show>

        </div>
        {{-- col --}}
    </div>
    {{-- row --}}
@endsection
