@php
    // Satu grafik per ukuran wilayah, masing-masing berskala sendiri: total mitra (ratusan)
    // tidak boleh menggencet jumlah kota (satuan) dalam satu sumbu yang sama. Disusun 2x2
    // agar batang horizontalnya cukup panjang untuk dibaca.
    $ukuranWilayah = [
        'kota' => 'Kota',
        'kecamatan' => 'Kecamatan',
        'kelurahan' => 'Kelurahan',
        'mitra' => 'Total Mitra',
    ];
@endphp

<div class="card" id="kartu-perbandingan-wilayah">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-chart-simple"></i>
            Visualisasi Rincian Sebaran Lokasi Mitra KSD
        </h3>
        {{-- Legenda tipe mitra di pojok kanan atas; berlaku untuk keempat grafik di bawah.
             m-0 ms-auto meniadakan margin negatif bawaan .card-actions (dibuat untuk tombol) agar
             ujung kanan legenda sejajar dengan tepi isi card-body, bukan menjorok ke luar. --}}
        @if ($sebaranPerTipe->sum('mitra') > 0)
            <div class="card-actions m-0 ms-auto d-flex flex-wrap justify-content-end gap-3">
                @foreach ($sebaranPerTipe as $tipe)
                    <span class="text-nowrap">
                        <span class="status-dot" style="background-color: var(--tblr-{{ $tipe['warna'] }})"></span>
                        {{ $tipe['label'] }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
    <div class="card-body">
        @if ($sebaranPerTipe->sum('mitra') > 0)
            <div class="row row-cards">
                @foreach ($ukuranWilayah as $kunci => $judul)
                    <div class="col-lg-6">
                        <div class="fw-bold mb-1">{{ $judul }}</div>
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
            const sebaran = @json($sebaranPerTipe);
            const ukuran = @json(array_keys($ukuranWilayah));

            // Tiap grafik = satu ukuran wilayah, tiga batang horizontal = tiga tipe mitra dengan urutan dan
            // warna yang sama di semua grafik (legenda di atas berlaku untuk keempatnya).
            ukuran.forEach(function(kunci) {
                const el = document.getElementById("chart-perbandingan-" + kunci);
                if (!el) {
                    return;
                }
                const nilai = sebaran.map((tipe) => tipe[kunci]);

                new ApexCharts(el, {
                    chart: {
                        type: "bar",
                        height: 100,
                        fontFamily: "inherit",
                        toolbar: {
                            show: false
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    series: sebaran.map((tipe) => ({
                        name: tipe.label,
                        data: [tipe[kunci]]
                    })),
                    colors: sebaran.map((tipe) => "var(--tblr-" + tipe.warna + ")"),
                    // Pada bar horizontal, xaxis adalah sumbu nilai. Angka tertulis langsung di ujung
                    // tiap batang, jadi sumbu nilai disembunyikan.
                    xaxis: {
                        categories: [""],
                        min: 0,
                        max: Math.ceil(Math.max(...nilai) * 1.15),
                        labels: {
                            show: false
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                    },
                    yaxis: {
                        labels: {
                            show: false
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            barHeight: "80%",
                            borderRadius: 4,
                            dataLabels: {
                                position: "top"
                            },
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        offsetX: 22,
                        style: {
                            fontSize: "14px",
                            fontWeight: 700,
                            colors: [warnaTeks]
                        },
                    },
                    stroke: {
                        show: true,
                        width: 4,
                        colors: ["transparent"]
                    },
                    legend: {
                        show: false
                    },
                    // Padding negatif merapatkan batang ke judul grafik (ruang bawaan Apex terlalu longgar).
                    grid: {
                        padding: {
                            top: -30,
                            bottom: -20,
                            left: -16,
                            right: 0
                        },
                        borderColor: "var(--tblr-border-color)",
                        strokeDashArray: 3,
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                    },
                    tooltip: {
                        theme: "dark",
                        shared: true,
                        intersect: false,
                    },
                }).render();
            });
        });
    </script>
@endpush
