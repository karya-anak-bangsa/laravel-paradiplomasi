{{--
    Kartu akumulasi dashboard.

    Kelompok "Mitra Biro KSD" dirender dari $akumulasiMitra, yang di
    DashboardController diturunkan dari enum App\Enums\TipeMitra — jadi jenis
    mitra baru otomatis muncul di sini tanpa berkas ini perlu disentuh.
    Kelompok "Riwayat Diplomasi" dirender dari $akumulasiRiwayat.

    Sebelumnya berkas ini berisi 9 blok markup kartu yang ditulis ulang satu per
    satu (±283 baris); markup kartunya kini ada di <x-stat-card>.
--}}

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-chart-simple"></i>
            <span class="text-dark">Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta</span>
        </h3>
    </div>

    <div class="card-body">
        <div class="row row-cards">
            {{-- Kolom kiri: grid kartu akumulasi (8/12) --}}
            <div class="col-lg-8">

                <div class="hr-text hr-text-start mt-0">Mitra Biro KSD</div>
                <div class="row row-cards mb-4">
                    @foreach ($akumulasiMitra as $mitra)
                        <x-stat-card
                            class="col-lg-3 col-sm-6"
                            :jumlah="$mitra->jumlah"
                            :label="$mitra->label"
                            :ikon="$mitra->ikon"
                            :warna="$mitra->warna"
                            :route="$mitra->route" />
                    @endforeach
                </div>
                {{-- row (grid mitra) --}}

                <div class="hr-text hr-text-start">Riwayat Diplomasi</div>
                <div class="row row-cards">
                    @foreach ($akumulasiRiwayat as $modul)
                        <x-stat-card
                            class="col-lg-4 col-sm-6"
                            :jumlah="$modul->jumlah"
                            :label="$modul->label"
                            :ikon="$modul->ikon"
                            :warna="$modul->warna"
                            :route="$modul->route" />
                    @endforeach
                </div>
                {{-- row (grid riwayat) --}}

            </div>
            {{-- col-lg-8 --}}

            {{-- Kolom kanan: chart (4/12) --}}
            <div class="col-lg-4">
                <div class="text-center fw-bold mb-2">Perbandingan Kegiatan Diplomasi</div>
                <div id="chart-akumulasi-modul" class="position-relative"></div>
                @foreach ($akumulasiRiwayat->chunk(3) as $baris)
                    <div class="text-center {{ $loop->first ? 'mt-3' : 'mt-1' }}">
                        @foreach ($baris as $modul)
                            <span class="status-dot @if (!$loop->first) ms-3 @endif" style="background-color: var(--tblr-{{ $modul->warnaChart }})"></span>
                            {{ $modul->label }}
                        @endforeach
                    </div>
                @endforeach
            </div>
            {{-- col-lg-4 --}}
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
                    series: @json($akumulasiRiwayat->pluck('jumlah')),
                    labels: @json($akumulasiRiwayat->pluck('label')),
                    colors: @json($akumulasiRiwayat->map(fn ($modul) => 'var(--tblr-' . $modul->warnaChart . ')')),
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
