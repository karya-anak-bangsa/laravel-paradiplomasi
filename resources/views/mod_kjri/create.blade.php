@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Konsulat Jenderal Republik Indonesia (KJRI)" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data KJRI">
        <form action="{{ route('kjri.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_kjri._form')
        </form>
    </x-page-body-form>
@endsection
