<div class="row">
    <div class="col-lg-8 mb-3">
        <x-form-input-text
            label="Nama Perwakilan RI"
            name="nama_perwakilan_ri"
            :required="true"
            :value="$perwakilanRi->nama_perwakilan_ri ?? null" />
    </div>

    <div class="col-lg-4 mb-3">
        <x-form-input-select
            label="Tipe Perwakilan RI"
            name="tipe_perwakilan_ri"
            :options="\App\Models\PerwakilanRi::TIPE_OPTIONS"
            :value="$perwakilanRi->tipe_perwakilan_ri ?? null"
            :required="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Keterangan"
            name="keterangan"
            rows="5"
            :value="$perwakilanRi->keterangan ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('perwakilan-ri.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
