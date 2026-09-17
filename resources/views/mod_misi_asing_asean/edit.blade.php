@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Asing untuk ASEAN" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data Misi Asing untuk ASEAN">
        <form action="{{ route('misi-asing-asean.update', $misiAsingAsean) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_misi_asing_asean._form')
        </form>
    </x-page-body-form>
@endsection
