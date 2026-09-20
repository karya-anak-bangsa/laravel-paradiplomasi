@extends('template.app')

@section('nav-acara-dki', 'active')
@section('page-header')
    <x-page-header title="Modul Acara DKI" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Acara DKI">
        <form action="{{ route('acara-dki.update', $acaraDki) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_acara_dki._form')
        </form>
    </x-page-body-form>
@endsection
