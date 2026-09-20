<div class="datagrid align-items-center mb-5">
    <x-show-field label="Format Undangan">{{ $misiPermanenAsean->format_undangan ?? '-' }}</x-show-field>
    <x-show-field label="Bendera Negara">
        <div class="d-flex align-items-center">
            <span class="flag flag-md flag-country-{{ $misiPermanenAsean->kode_negara }} me-2"></span>
            <span class="fw-bold">{{ $misiPermanenAsean->nama_negara }}</span>
        </div>
    </x-show-field>
</div>
<div class="datagrid align-items-center mb-5">
    <x-show-field label="Misi Resmi">
        <p class="fst-normal mb-auto">{{ $misiPermanenAsean->nama_misi_permanen_asean_id ?? '-' }}</p>
        <small class="fst-italic text-primary mb-auto">{{ $misiPermanenAsean->nama_misi_permanen_asean_en ?? '-' }}</small>
    </x-show-field>
    <x-show-field label="Diplomat">{{ $misiPermanenAsean->nama_diplomat ?? '-' }}</x-show-field>
</div>
<div class="datagrid align-items-center mb-0">
    <x-show-field label="Email">{{ $misiPermanenAsean->email_kantor ?? '-' }}</x-show-field>
    <x-show-field label="Telepon">{{ $misiPermanenAsean->telepon_kantor ?? '-' }}</x-show-field>
</div>
