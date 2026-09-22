@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Konsulat Jenderal Republik Indonesia (KJRI)" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data KJRI">
        <form action="{{ route('kjri.update', $kjri) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_kjri._form')
        </form>
    </x-page-body-form>
@endsection
