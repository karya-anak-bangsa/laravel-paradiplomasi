@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Asing untuk ASEAN" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data Misi Asing untuk ASEAN">
        <form action="{{ route('misi-asing-asean.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_misi_asing_asean._form')
        </form>
    </x-page-body-form>
@endsection
