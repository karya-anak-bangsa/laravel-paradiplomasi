@extends('template.app')

@section('nav-dashboard', 'active')
@section('page-header')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-title">Dashboard</h2>
        </div>
    </div>
@endsection

@section('page-content')
    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta</h3>
                </div>
                <div class="card-body">

                    <div class="row row-cards">
                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-blue-lt">KB</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Kedutaan Besar</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-green-lt">KS</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Kerjasama</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-yellow-lt">KL</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Kolaborasi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-red-lt">UD</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Undangan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-blue-lt">AU</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Audiensi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-green-lt">VI</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Kunjungan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-yellow-lt">EV</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="fw-semibold">9999 Data</div>
                                            <div class="text-secondary">Jumlah Acara DKI</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row row-cards mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Analisa Statistik Pelayanan Perwakilan Negara Asing</h3>
                </div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Mitra Aktif</h3>
                </div>
                <div class="card-body">
                    <div class="divide-y">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="flag flag-sm flag-country-us"></span>
                            </div>
                            <div class="col-auto">
                                <div class="text-truncate">
                                    <span class="fst-normal mb-0">Kedutaan Besar Amerika Serikat</span>
                                </div>
                                <div class="text-secondary">
                                    <small class="fst-italic mb-0">Embassy of the United States of America</small>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="flag flag-sm flag-country-gb"></span>
                            </div>
                            <div class="col-auto">
                                <div class="text-truncate">
                                    <span class="fst-normal mb-0">Kedutaan Besar Britania Raya</span>
                                </div>
                                <div class="text-secondary">
                                    <small class="fst-italic mb-0">Embassy of the United Kingdom</small>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="flag flag-sm flag-country-de"></span>
                            </div>
                            <div class="col-auto">
                                <div class="text-truncate">
                                    <span class="fst-normal mb-0">Kedutaan Besar Republik Federal Jerman</span>
                                </div>
                                <div class="text-secondary">
                                    <small class="fst-italic mb-0">Embassy of the Federal Republic of Germany</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Peta Geospasial Sebaran Kedutaan Besar</h3>
                </div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>

@endsection
