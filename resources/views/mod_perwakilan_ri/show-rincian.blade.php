<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama Perwakilan RI">
        <span class="fw-bold">{{ $perwakilanRi->nama_perwakilan_ri }}</span>
    </x-show-field>
    <x-show-field label="Tipe Perwakilan RI">{{ $perwakilanRi->tipe_perwakilan_ri_label ?? '-' }}</x-show-field>
    <x-show-field label="Keterangan">{{ $perwakilanRi->keterangan ?? '-' }}</x-show-field>
</div>
