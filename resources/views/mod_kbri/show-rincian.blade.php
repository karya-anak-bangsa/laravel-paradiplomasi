<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama KBRI">
        <span class="fw-bold">{{ $kbri->nama_kbri }}</span>
    </x-show-field>
    <x-show-field label="Keterangan">{{ $kbri->keterangan ?? '-' }}</x-show-field>
</div>
