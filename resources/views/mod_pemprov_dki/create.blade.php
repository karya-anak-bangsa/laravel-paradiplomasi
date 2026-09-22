@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Pemerintah Provinsi DKI Jakarta" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data Pemprov DKI Jakarta">
        <form action="{{ route('pemprov-dki.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_pemprov_dki._form')
        </form>
    </x-page-body-form>
@endsection
