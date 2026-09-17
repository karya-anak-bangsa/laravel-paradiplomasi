<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-flag me-1"></i>
            Mitra Paling Aktif
        </h3>
    </div>
    <div class="card-body">
        <div class="text-secondary fw-bold text-uppercase mb-2">Kedutaan Besar</div>
        @include('mod_dashboard.dashboard-mitra-aktif-grid', [
            'daftarMitra' => $mitraAktifKedutaanBesar,
            'labelNamaResmi' => 'nama_kedutaan_besar_id',
        ])

        <div class="text-secondary fw-bold text-uppercase mt-4 mb-2">Misi Asing untuk ASEAN</div>
        @include('mod_dashboard.dashboard-mitra-aktif-grid', [
            'daftarMitra' => $mitraAktifMisiAsingAsean,
            'labelNamaResmi' => 'nama_misi_asing_asean_id',
        ])

        <div class="text-secondary fw-bold text-uppercase mt-4 mb-2">Misi Permanen Negara ASEAN</div>
        @include('mod_dashboard.dashboard-mitra-aktif-grid', [
            'daftarMitra' => $mitraAktifMisiPermanenAsean,
            'labelNamaResmi' => 'nama_misi_permanen_asean_id',
        ])
    </div>
    {{-- card-body --}}
</div>
{{-- card --}}
