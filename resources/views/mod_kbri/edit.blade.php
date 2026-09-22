@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kedutaan Besar Republik Indonesia (KBRI)" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data KBRI">
        <form action="{{ route('kbri.update', $kbri) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_kbri._form')
        </form>
    </x-page-body-form>
@endsection
