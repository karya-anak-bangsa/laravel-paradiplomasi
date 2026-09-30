<div class="card" id="kartu-mitra-aktif">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-flag me-1"></i>
            Mitra Diplomasi Paling Aktif
        </h3>
        <x-dashboard-filter-tahun name="tahun_mitra" :tahun-options="$tahunOptions" anchor="kartu-mitra-aktif" />
    </div>
    <div class="card-body">
        @include('mod_dashboard.dashboard-mitra-aktif-grid', [
            'daftarMitra' => $mitraAktif,
        ])
    </div>
    {{-- card-body --}}
</div>
{{-- card --}}
