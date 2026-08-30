@extends('template.app')

@section('nav-kedutaan-besar', 'active')
@section('page-header')
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Data Kedutaan Besar</h2>
            <span class="text-secondary">Daftar perwakilan negara asing yang terdaftar</span>
        </div>
        <div class="col-auto">
            <a class="btn btn-success" href="{{-- route('kedutaan-besar.create') --}}">
                <i class="fa-solid fa-plus me-1"></i>Tambah Data
            </a>
        </div>
    </div>
@endsection

@section('page-content')
@endsection
