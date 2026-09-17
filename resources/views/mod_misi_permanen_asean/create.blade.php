@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Permanen Negara ASEAN" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data Misi Permanen Negara ASEAN">
        <form action="{{ route('misi-permanen-asean.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_misi_permanen_asean._form')
        </form>
    </x-page-body-form>
@endsection
