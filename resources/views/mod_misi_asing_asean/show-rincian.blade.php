<div class="datagrid align-items-center mb-5">
    <x-show-field label="Format Undangan">{{ $misiAsingAsean->format_undangan ?? '-' }}</x-show-field>
    <x-show-field label="Bendera Negara">
        <div class="d-flex align-items-center">
            <span class="flag flag-md flag-country-{{ $misiAsingAsean->kode_negara }} me-2"></span>
            <span class="fw-bold">{{ $misiAsingAsean->nama_negara }}</span>
        </div>
    </x-show-field>
</div>
<div class="datagrid align-items-center mb-5">
    <x-show-field label="Misi Resmi">{{ $misiAsingAsean->nama_misi_asing_asean_id ?? '-' }}</x-show-field>
    <x-show-field label="Diplomat">{{ $misiAsingAsean->nama_diplomat ?? '-' }}</x-show-field>
</div>
<div class="datagrid align-items-center mb-0">
    <x-show-field label="Email">{{ $misiAsingAsean->email_kantor ?? '-' }}</x-show-field>
    <x-show-field label="Telepon">{{ $misiAsingAsean->telepon_kantor ?? '-' }}</x-show-field>
</div>
