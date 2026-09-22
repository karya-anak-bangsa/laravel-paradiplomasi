@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Perutusan Tetap Republik Indonesia (PTRI)" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data PTRI">
        <form action="{{ route('ptri.update', $ptri) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_ptri._form')
        </form>
    </x-page-body-form>
@endsection
