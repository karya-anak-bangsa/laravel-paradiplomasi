@extends('template.app')

{{-- content --}}
@section('nav-kerjasama', 'active')
@section('page-header')
    <x-page-header title="Modul Kerjasama" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Ubah Kerjasama">
        <form action="{{-- ke controller update --}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mod_kerjasama._form')
        </form>
    </x-page-body-form>
@endsection
