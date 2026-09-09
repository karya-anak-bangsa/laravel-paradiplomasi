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

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            @include('mod_kedutaan_besar.show-rincian-data')
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

    {{--  Riwayat Diplomasi --}}
    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            @include('mod_kedutaan_besar.show-riwayat-diplomasi')
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

@endsection
