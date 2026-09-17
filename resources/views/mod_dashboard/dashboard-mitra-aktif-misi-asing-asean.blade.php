<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-flag me-1"></i>
            Misi Asing untuk ASEAN Paling Aktif
        </h3>
    </div>
    <div class="card-body">
        @include('mod_dashboard.dashboard-mitra-aktif-grid', [
            'daftarMitra' => $mitraAktifMisiAsingAsean,
            'labelNamaResmi' => 'nama_misi_asing_asean_id',
        ])
    </div>
    {{-- card-body --}}
</div>
{{-- card --}}
