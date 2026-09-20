<div class="datagrid align-items-center mb-0">
    <x-show-field label="Nama Non Perwakilan Negara Asing">
        <span class="fw-bold">{{ $nonPerwakilanNegaraAsing->nama_non_perwakilan_negara_asing }}</span>
    </x-show-field>
    <x-show-field label="Keterangan">{{ $nonPerwakilanNegaraAsing->keterangan ?? '-' }}</x-show-field>
</div>
