@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kantor Dagang Asing" back-route="kantor-dagang-asing.index" />
@endsection

@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">

            <x-page-body-show title="Rincian Data">
                @include('mod_kantor_dagang_asing.show-rincian')
            </x-page-body-show>

            <x-page-body-show title="Riwayat Diplomasi">
                <x-mitra-riwayat :mitra="$kantorDagangAsing" sebutan="kantor dagang ini" />
            </x-page-body-show>

        </div>
        {{-- col --}}
    </div>
    {{-- row --}}
@endsection
