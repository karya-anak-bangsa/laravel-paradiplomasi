@extends('template.app')

{{-- content --}}
@section('nav-kolaborasi', 'active')
@section('page-header')
    <x-page-header title="Modul Kolaborasi" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Tambah Kolaborasi">
        <form action="{{ route('kolaborasi.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_kolaborasi._form')
        </form>
    </x-page-body-form>
@endsection
