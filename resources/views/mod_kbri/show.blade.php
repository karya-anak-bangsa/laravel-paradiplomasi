@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kedutaan Besar Republik Indonesia (KBRI)" back-route="kbri.index" />
@endsection

@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">

            <x-page-body-show title="Rincian Data">
                @include('mod_kbri.show-rincian')
            </x-page-body-show>

            <x-page-body-show title="Riwayat Diplomasi">
                <x-mitra-riwayat :mitra="$kbri" sebutan="KBRI ini" />
            </x-page-body-show>

        </div>
        {{-- col --}}
    </div>
    {{-- row --}}
@endsection
