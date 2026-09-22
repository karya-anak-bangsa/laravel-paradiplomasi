@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Perutusan Tetap Republik Indonesia (PTRI)" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data PTRI">
        <form action="{{ route('ptri.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_ptri._form')
        </form>
    </x-page-body-form>
@endsection
