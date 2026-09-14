@extends('template.app')

{{-- content --}}
@section('nav-kolaborasi', 'active')
@section('page-header')
    <x-page-header title="Modul Kolaborasi" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Ubah Kolaborasi">
        <form action="{{ route('kolaborasi.update', $kolaborasi) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_kolaborasi._form')
        </form>
    </x-page-body-form>
@endsection
