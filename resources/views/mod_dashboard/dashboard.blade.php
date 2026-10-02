@extends('template.app')

@section('nav-dashboard', 'active')
@section('page-header')

    {{-- Session Login --}}
    <div class="row row-cards">
        <div class="col-lg-12">
            <div class="alert alert-primary alert-dismissible" role="alert">
                {{-- auth_nama diisi AuthController::login(): "Administrator" (admin) / "Tamu Biro KSD" (guest) --}}
                <span>Selamat Datang, Anda login sebagai {{ session('auth_nama') }}</span>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        </div>
    </div>

    <x-page-header title="Dashboard" />
@endsection

@section('page-content')

    {{-- Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta --}}
    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            @include('mod_dashboard.dashboard-akumulasi-kegiatan')
        </div>
    </div>

    {{-- Analisa Statistik Pelayanan Perwakilan Negara Asing --}}
    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            @include('mod_dashboard.dashboard-analisa-statistik')
        </div>
    </div>

    {{-- Mitra Paling Aktif --}}
    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            @include('mod_dashboard.dashboard-mitra-aktif')
        </div>
    </div>

    {{-- Peta Sebaran & Pencarian Lokasi Kedutaan Besar --}}
    <div class="row row-cards mb-4">
        <div class="col-12">
            @include('mod_dashboard.dashboard-peta-sebaran')
        </div>
    </div>

    {{-- Perbandingan Sebaran Wilayah per Tipe Mitra (tidak terpengaruh filter tipe_wilayah) --}}
    <div class="row row-cards mb-4">
        <div class="col-12">
            @include('mod_dashboard.dashboard-perbandingan-wilayah')
        </div>
    </div>

    {{-- Rincian Sebaran Lokasi Kedutaan Besar --}}
    <div class="row row-cards mb-0">
        <div class="col-12">
            @include('mod_dashboard.dashboard-rincian-sebaran')
        </div>
    </div>
@endsection
