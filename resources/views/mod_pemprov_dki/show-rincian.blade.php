<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama Perangkat Daerah">
        <span class="fw-bold">{{ $pemprovDki->nama_pemprov_dki }}</span>
    </x-show-field>
    <x-show-field label="Keterangan">{{ $pemprovDki->keterangan ?? '-' }}</x-show-field>
</div>
