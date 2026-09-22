@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kedutaan Besar Republik Indonesia (KBRI)" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data KBRI">
        <form action="{{ route('kbri.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_kbri._form')
        </form>
    </x-page-body-form>
@endsection
