@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Pemerintah Provinsi DKI Jakarta" back-route="pemprov-dki.index" />
@endsection

@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">

            <x-page-body-show title="Rincian Data">
                @include('mod_pemprov_dki.show-rincian')
            </x-page-body-show>

            <x-page-body-show title="Riwayat Diplomasi">
                <x-mitra-riwayat :mitra="$pemprovDki" sebutan="perangkat daerah ini" />
            </x-page-body-show>

        </div>
        {{-- col --}}
    </div>
    {{-- row --}}
@endsection
