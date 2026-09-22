<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama PTRI">
        <span class="fw-bold">{{ $ptri->nama_ptri }}</span>
    </x-show-field>
    <x-show-field label="Keterangan">{{ $ptri->keterangan ?? '-' }}</x-show-field>
</div>
