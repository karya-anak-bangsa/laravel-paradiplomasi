@extends('template.app')

@section('nav-kegiatan', 'active')
@section('page-header')
    <x-page-header title="Modul Acara DKI" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Acara DKI">
        <form action="{{ route('acara-dki.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_acara_dki._form')
        </form>
    </x-page-body-form>
@endsection
