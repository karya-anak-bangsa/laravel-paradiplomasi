<div class="card" id="kartu-analisa">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-chart-simple"></i>
            Analisa Statistik Diplomasi di Biro KSD Setda DKI Jakarta
        </h3>
        <x-dashboard-filter-tahun name="tahun_analisa" :tahun-options="$tahunOptions" anchor="kartu-analisa" />
    </div>
    <div class="card-body">
        <div class="row row-cards">
            @foreach ($moduleLabels as $index => $modul)
                <div class="col-lg-4">
                    <div class="text-center fw-bold mb-2">{{ $modul }}</div>
                    <div id="chart-status-modul-{{ $index }}" class="position-relative"></div>
                    <div class="text-center mt-3">
                        <span class="status-dot" style="background-color: var(--tblr-blue)"></span> Berjalan
                        <span class="status-dot ms-3" style="background-color: var(--tblr-success)"></span> Selesai
                        <span class="status-dot ms-3" style="background-color: var(--tblr-warning)"></span> Tunda
                    </div>
                    <div class="text-center mt-1 mb-4">
                        <span class="status-dot" style="background-color: var(--tblr-danger)"></span> Batal
                        <span class="status-dot ms-3" style="background-color: var(--tblr-secondary)"></span> Regret
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Data donat; dibaca skrip di bawah dan ikut berganti saat kartu diganti (lihat dashboard-ajax) --}}
    <script type="application/json" data-kartu-data>
        @json(['statusLabels' => $statusList, 'pieSeriesPerModul' => $pieSeriesPerModul])
    </script>
</div>

@push('scripts')
    <script>
        Dashboard.daftar("kartu-analisa", function(kartu) {
            const {statusLabels, pieSeriesPerModul} = Dashboard.data(kartu);
            const statusColors = [
                "var(--tblr-blue)",
                "var(--tblr-success)",
                "var(--tblr-warning)",
                "var(--tblr-danger)",
                "var(--tblr-secondary)",
            ];
            if (!window.ApexCharts) return;

            const charts = [];
            pieSeriesPerModul.forEach(function(series, index) {
                const el = kartu.querySelector("#chart-status-modul-" + index);
                if (!el) return;

                const chart = new ApexCharts(el, {
                    chart: {
                        type: "donut",
                        fontFamily: "inherit",
                        height: 220,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    series: series,
                    labels: statusLabels,
                    colors: statusColors,
                    tooltip: {
                        theme: "dark",
                        fillSeriesColor: false,
                    },
                    legend: {
                        show: false
                    },
                });
                chart.render();
                charts.push(chart);
            });

            return () => charts.forEach((chart) => chart.destroy());
        });
    </script>
@endpush
