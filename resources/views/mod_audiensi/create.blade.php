@extends('template.app')

{{-- content --}}
@section('nav-audiensi', 'active')
@section('page-header')
    <x-page-header title="Modul Audiensi" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Tambah Audiensi">
        <form action="{{ route('audiensi.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mod_audiensi._form')
        </form>
    </x-page-body-form>
@endsection
