@extends('template.app')

{{-- content --}}
@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kedutaan Besar" back-route="kedutaan-besar.index" />
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-8">

            <x-page-body-show title="Rincian Data">
                @include('mod_kedutaan_besar.show-rincian')
            </x-page-body-show>

            <x-page-body-show title="Riwayat Diplomasi">
                <x-mitra-riwayat :mitra="$kedutaanBesar" sebutan="kedutaan ini" />
            </x-page-body-show>

        </div>
        {{-- col --}}

        <div class="col-lg-4">
            <x-page-body-show title="Peta Lokasi">
                @include('mod_kedutaan_besar.show-peta')
            </x-page-body-show>
        </div>
        {{-- col --}}

    </div>
    {{-- row --}}
@endsection
