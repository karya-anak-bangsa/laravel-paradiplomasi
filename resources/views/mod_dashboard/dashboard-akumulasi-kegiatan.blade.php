<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-chart-simple"></i>
            <span class="text-dark">Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta</span>
        </h3>
    </div>

    {{-- icon icon-tabler icons-tabler-filled icon-tabler-home --}}
    <div class="card-body">
        <div class="row row-cards mb-5">
            {{-- Jumlah Kedutaan Besar --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-blue-lt">
                                    <i class="fa-solid fa-landmark"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['kedutaan_besar'] }} Data</div>
                                <div class="text-secondary">Kedutaan Besar</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- Jumlah Misi Asing --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-blue-lt">
                                    <i class="fa-solid fa-landmark"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['misi_asing_asean'] }} Data</div>
                                <div class="text-secondary">Misi Asing untuk ASEAN</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- Jumlah Misi Permanen --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-blue-lt">
                                    <i class="fa-solid fa-landmark"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['misi_permanen_asean'] }} Data</div>
                                <div class="text-secondary">Misi Permanen Negara ASEAN</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- 1. Jumlah Kerjasama --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-green-lt">
                                    <i class="fa-solid fa-folder-closed"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['kerjasama'] }} Data</div>
                                <div class="text-secondary">Jumlah Kerjasama</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- 2. Jumlah Kolaborasi --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-yellow-lt">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['kolaborasi'] }} Data</div>
                                <div class="text-secondary">Jumlah Kolaborasi</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- 3. Jumlah Undangan --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-red-lt">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['undangan'] }} Data</div>
                                <div class="text-secondary">Jumlah Undangan</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- 4. Jumlah Audiensi --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-success-lt">
                                    <i class="fa-solid fa-comments"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['audiensi'] }} Data</div>
                                <div class="text-secondary">Jumlah Audiensi</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- 5. Jumlah Kunjungan --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-warning-lt">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">{{ $dash_akumulasi['kunjungan'] }} Data</div>
                                <div class="text-secondary">Jumlah Kunjungan</div>
                            </div>
                        </div>
                    </div>
                    {{-- card-body --}}
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}

            {{-- 6. Jumlah Acara DKI --}}
            {{-- <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar bg-danger-lt">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="fw-semibold">9999 Data</div>
                                <div class="text-secondary">Jumlah Acara DKI</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- col --}}
        </div>
        {{-- row --}}

        <div class="row row-cards mb-5">
            <div class="col-lg-4">
                <div class="text-center fw-bold mb-2">Perbandingan Kegiatan Diplomasi</div>
                <div id="chart-akumulasi-modul" class="position-relative"></div>
                <div class="text-center mt-3">
                    <span class="status-dot" style="background-color: var(--tblr-primary)"></span> Kerjasama
                    <span class="status-dot ms-3" style="background-color: var(--tblr-yellow)"></span> Kolaborasi
                    <span class="status-dot ms-3" style="background-color: var(--tblr-red)"></span> Undangan
                </div>
                <div class="text-center mt-1">
                    <span class="status-dot" style="background-color: var(--tblr-azure)"></span> Audiensi
                    <span class="status-dot ms-3" style="background-color: var(--tblr-green)"></span> Kunjungan
                </div>
            </div>
            {{-- col --}}
        </div>
        {{-- row --}}
    </div>
    {{-- card-body --}}
</div>
{{-- card --}}

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-akumulasi-modul"), {
                    chart: {
                        type: "donut",
                        fontFamily: "inherit",
                        height: 240,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    series: [
                        {{ $dash_akumulasi['kerjasama'] }},
                        {{ $dash_akumulasi['kolaborasi'] }},
                        {{ $dash_akumulasi['undangan'] }},
                        {{ $dash_akumulasi['audiensi'] }},
                        {{ $dash_akumulasi['kunjungan'] }},
                    ],
                    labels: ["Kerjasama", "Kolaborasi", "Undangan", "Audiensi", "Kunjungan"],
                    colors: [
                        "var(--tblr-primary)",
                        "var(--tblr-yellow)",
                        "var(--tblr-red)",
                        "var(--tblr-azure)",
                        "var(--tblr-green)",
                    ],
                    tooltip: {
                        theme: "dark",
                        fillSeriesColor: false,
                    },
                    legend: {
                        show: false
                    },
                }).render();
        });
    </script>
@endpush
