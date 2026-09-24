@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Pusat Kebudayaan Asing" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data Pusat Kebudayaan Asing">
        <form action="{{ route('pusat-kebudayaan-asing.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_pusat_kebudayaan_asing._form')
        </form>
    </x-page-body-form>
@endsection
