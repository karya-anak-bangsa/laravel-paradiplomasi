@extends('template.app')

{{-- content --}}
@section('nav-undangan', 'active')
@section('page-header')
    <x-page-header title="Modul Undangan" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Ubah Undangan">
        <form action="{{ route('undangan.update', $undangan) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_undangan._form')
        </form>
    </x-page-body-form>
@endsection
