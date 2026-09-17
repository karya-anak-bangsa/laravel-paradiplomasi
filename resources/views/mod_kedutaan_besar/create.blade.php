@extends('template.app')

{{-- content --}}
@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kedutaan Besar" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Tambah Data Kedutaan Besar">
        <form action="{{ route('kedutaan-besar.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_kedutaan_besar._form')
        </form>
    </x-page-body-form>
@endsection
