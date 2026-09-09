<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-chart-simple"></i>
            Analisa Statistik Pelayanan Perwakilan Negara Asing
        </h3>
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
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusLabels = @json($statusList);
            const pieSeriesPerModul = @json($pieSeriesPerModul);
            const statusColors = [
                "var(--tblr-blue)",
                "var(--tblr-success)",
                "var(--tblr-warning)",
                "var(--tblr-danger)",
                "var(--tblr-secondary)",
            ];

            pieSeriesPerModul.forEach(function(series, index) {
                const el = document.getElementById("chart-status-modul-" + index);
                window.ApexCharts && el &&
                    new ApexCharts(el, {
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
                    }).render();
            });
        });
    </script>
@endpush
