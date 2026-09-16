@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header
        title="Modul Misi Permanen Negara ASEAN"
        back-route="misi-permanen-asean.index">
    </x-page-header>
@endsection

@section('page-content')
    <x-page-body-show title="Rincian Data - {{ $misiPermanenAsean->nama_negara }}">
        @include('mod_misi_permanen_asean.show-rincian-data')
    </x-page-body-show>
@endsection
