<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama KJRI">
        <span class="fw-bold">{{ $kjri->nama_kjri }}</span>
    </x-show-field>
    <x-show-field label="Keterangan">{{ $kjri->keterangan ?? '-' }}</x-show-field>
</div>
