@extends('template.app')

{{-- content --}}
@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Mitra Perwakilan Negara Asing" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Ubah Data Kedutaan Besar">
        <form action="{{ route('kedutaan-besar.update', $kedutaanBesar) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_kedutaan_besar._form')
        </form>
    </x-page-body-form>
@endsection
