@extends('template.app')

{{-- content --}}
@section('nav-undangan', 'active')
@section('page-header')
    <x-page-header title="Modul Undangan" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Tambah Undangan">
        <form action="{{ route('undangan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mod_undangan._form')
        </form>
    </x-page-body-form>
@endsection
