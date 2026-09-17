<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-flag me-1"></i>
            Misi Permanen Negara ASEAN Paling Aktif
        </h3>
    </div>
    <div class="card-body">
        @include('mod_dashboard.dashboard-mitra-aktif-grid', [
            'daftarMitra' => $mitraAktifMisiPermanenAsean,
            'labelNamaResmi' => 'nama_misi_permanen_asean_id',
        ])
    </div>
    {{-- card-body --}}
</div>
{{-- card --}}
