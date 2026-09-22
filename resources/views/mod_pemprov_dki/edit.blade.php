@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Pemerintah Provinsi DKI Jakarta" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data Pemprov DKI Jakarta">
        <form action="{{ route('pemprov-dki.update', $pemprovDki) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_pemprov_dki._form')
        </form>
    </x-page-body-form>
@endsection
