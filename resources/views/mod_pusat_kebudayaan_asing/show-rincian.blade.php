<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama Pusat Kebudayaan Asing">
        <span class="fw-bold">{{ $pusatKebudayaanAsing->nama_pusat_kebudayaan_asing }}</span>
    </x-show-field>
    <x-show-field label="Keterangan">{{ $pusatKebudayaanAsing->keterangan ?? '-' }}</x-show-field>
</div>
