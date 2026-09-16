@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header
        title="Modul Misi Asing untuk ASEAN"
        back-route="misi-asing-asean.index">
    </x-page-header>
@endsection

@section('page-content')
    <x-page-body-show title="Rincian Data - {{ $misiAsingAsean->nama_negara }}">
        @include('mod_misi_asing_asean.show-rincian-data')
    </x-page-body-show>
@endsection
