<div class="datagrid align-items-center mb-5">
    <x-show-field label="Format Undangan">{{ $kedutaanBesar->format_undangan }}</x-show-field>
    <x-show-field label="Bendera Negara">
        <div class="d-flex align-items-center">
            <span class="flag flag-md flag-country-{{ $kedutaanBesar->kode_negara }} me-2"></span>
            <span class="fw-bold">{{ $kedutaanBesar->nama_negara }}</span>
        </div>
    </x-show-field>
</div>
<div class="datagrid align-items-center mb-5">
    <x-show-field label="Kedutaan Besar">
        <p class="fst-normal mb-auto">{{ $kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</p>
        <small class="fst-italic text-primary mb-auto">{{ $kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</small>
    </x-show-field>
    <x-show-field label="Diplomat">
        <p class="fst-normal mb-auto">{{ $kedutaanBesar->nama_diplomat ?? '-' }}</p>
        <small class="fst-italic text-primary mb-auto">{{ $kedutaanBesar->jabatan_diplomat ?? '-' }}</small>
    </x-show-field>
</div>
<div class="datagrid align-items-center mb-0">
    <x-show-field label="Email">{{ $kedutaanBesar->email_kantor ?? '-' }}</x-show-field>
    <x-show-field label="Telepon">{{ $kedutaanBesar->telepon_kantor ?? '-' }}</x-show-field>
</div>
