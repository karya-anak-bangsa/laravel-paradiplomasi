@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Non Perwakilan Negara Asing" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data Non Perwakilan Negara Asing">
        <form action="{{ route('non-perwakilan-negara-asing.update', $nonPerwakilanNegaraAsing) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_non_perwakilan_negara_asing._form')
        </form>
    </x-page-body-form>
@endsection
