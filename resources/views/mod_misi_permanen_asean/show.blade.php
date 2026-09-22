@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Permanen Negara ASEAN" back-route="misi-permanen-asean.index" />
@endsection

@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-8">

            <x-page-body-show title="Rincian Data">
                @include('mod_misi_permanen_asean.show-rincian')
            </x-page-body-show>

            <x-page-body-show title="Riwayat Diplomasi">
                <x-mitra-riwayat :mitra="$misiPermanenAsean" sebutan="misi ini" />
            </x-page-body-show>

        </div>
        {{-- col --}}

        <div class="col-lg-4">
            <x-page-body-show title="Peta Lokasi">
                @include('mod_misi_permanen_asean.show-peta')
            </x-page-body-show>
        </div>
        {{-- col --}}

    </div>
    {{-- row --}}
@endsection
