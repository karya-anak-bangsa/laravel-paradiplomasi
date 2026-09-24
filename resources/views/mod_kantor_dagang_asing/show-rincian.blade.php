<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama Kantor Dagang Asing">
        <span class="fw-bold">{{ $kantorDagangAsing->nama_kantor_dagang_asing }}</span>
    </x-show-field>
    <x-show-field label="Keterangan">{{ $kantorDagangAsing->keterangan ?? '-' }}</x-show-field>
</div>
