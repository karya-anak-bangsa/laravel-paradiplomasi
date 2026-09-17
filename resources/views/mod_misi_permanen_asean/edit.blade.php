@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Permanen Negara ASEAN" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data Misi Permanen Negara ASEAN">
        <form action="{{ route('misi-permanen-asean.update', $misiPermanenAsean) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_misi_permanen_asean._form')
        </form>
    </x-page-body-form>
@endsection
