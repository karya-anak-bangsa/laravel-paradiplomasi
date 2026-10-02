@php
    // Dua grafik batang berkelompok: tiap kelompok = satu wilayah, tiap batang dalam kelompok = satu
    // tipe mitra berbasis negara (urutan dan warna sama di kedua grafik, legenda di header berlaku
    // untuk keduanya). Wilayahnya dipilih oleh App\Support\SebaranWilayah::perWilayah().
    $grafikWilayah = [
        'kecamatan' => ['judul' => 'Berdasarkan Kecamatan', 'satuan' => 'kecamatan'],
        'kelurahan' => ['judul' => 'Berdasarkan Kelurahan', 'satuan' => 'kelurahan'],
    ];
@endphp

<div class="card" id="kartu-perbandingan-wilayah">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-chart-simple"></i>
            Visualisasi Rincian Sebaran Lokasi Mitra KSD
        </h3>
        {{-- Legenda tipe mitra di pojok kanan atas; berlaku untuk kedua grafik di bawah.
             m-0 ms-auto meniadakan margin negatif bawaan .card-actions (dibuat untuk tombol) agar
             ujung kanan legenda sejajar dengan tepi isi card-body, bukan menjorok ke luar. --}}
        @if ($sebaranWilayah['ada'])
            <div class="card-actions m-0 ms-auto d-flex flex-wrap justify-content-end gap-3">
                @foreach ($sebaranWilayah['tipe'] as $tipe)
                    <span class="text-nowrap">
                        <span class="status-dot" style="background-color: var(--tblr-{{ $tipe['warna'] }})"></span>
                        {{ $tipe['label'] }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
    <div class="card-body">
        @if ($sebaranWilayah['ada'])
            <div class="row row-cards">
                @foreach ($grafikWilayah as $kunci => $grafik)
                    <div class="col-lg-6">
                        <div class="fw-bold">{{ $grafik['judul'] }}</div>
                        <div class="text-secondary small mb-2">
                            Jumlah mitra di {{ $grafik['satuan'] }} terpadat pada {{ implode(' dan ', $sebaranWilayah[$kunci]['kota']) }}
                        </div>
                        <div id="chart-perbandingan-{{ $kunci }}"></div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-secondary text-center py-5">Belum ada data wilayah.</div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (!window.ApexCharts) {
                return;
            }

            const warnaTeks = "var(--tblr-body-color)";
            const sebaran = @json($sebaranWilayah);
            const warna = sebaran.tipe.map((tipe) => "var(--tblr-" + tipe.warna + ")");

            ["kecamatan", "kelurahan"].forEach(function(kunci) {
                const el = document.getElementById("chart-perbandingan-" + kunci);
                if (!el) {
                    return;
                }
                const grafik = sebaran[kunci];

                new ApexCharts(el, {
                    chart: {
                        type: "bar",
                        height: 320,
                        fontFamily: "inherit",
                        toolbar: {
                            show: false
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    series: grafik.series,
                    colors: warna,
                    // Kategori berupa [nama wilayah, induknya] -> Apex menulisnya dalam dua baris.
                    xaxis: {
                        categories: grafik.kategori,
                        labels: {
                            rotate: 0,
                            hideOverlappingLabels: false,
                            style: {
                                colors: warnaTeks
                            },
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                    },
                    // Angka tertulis di atas tiap batang; skala "rapi" dari Apex memberi ruang di atas batang tertinggi.
                    yaxis: {
                        min: 0,
                        forceNiceScale: true,
                        labels: {
                            formatter: (nilai) => Math.round(nilai),
                            style: {
                                colors: warnaTeks
                            },
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "70%",
                            borderRadius: 4,
                            dataLabels: {
                                position: "top"
                            },
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -22,
                        style: {
                            fontSize: "13px",
                            fontWeight: 700,
                            colors: [warnaTeks]
                        },
                    },
                    stroke: {
                        show: true,
                        width: 3,
                        colors: ["transparent"]
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        borderColor: "var(--tblr-border-color)",
                        strokeDashArray: 3,
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                    },
                    tooltip: {
                        theme: "dark",
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: (nilai) => nilai + " mitra"
                        },
                    },
                }).render();
            });
        });
    </script>
@endpush
