<div class="row">
    <div class="col-lg-12 mb-3">
        <x-form-input-text
            label="Nama Pusat Kebudayaan Asing"
            name="nama_pusat_kebudayaan_asing"
            :required="true"
            :value="$pusatKebudayaanAsing->nama_pusat_kebudayaan_asing ?? null" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Keterangan"
            name="keterangan"
            rows="5"
            :value="$pusatKebudayaanAsing->keterangan ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('pusat-kebudayaan-asing.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
