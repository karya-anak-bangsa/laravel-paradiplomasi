@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Perwakilan RI di Luar Negeri" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data Perwakilan RI">
        <form action="{{ route('perwakilan-ri.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_perwakilan_ri._form')
        </form>
    </x-page-body-form>
@endsection
