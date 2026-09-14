@extends('template.app')

{{-- content --}}
@section('nav-audiensi', 'active')
@section('page-header')
    <x-page-header title="Modul Audiensi" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Ubah Audiensi">
        <form action="{{ route('audiensi.update', $audiensi) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('mod_audiensi._form')
        </form>
    </x-page-body-form>
@endsection
