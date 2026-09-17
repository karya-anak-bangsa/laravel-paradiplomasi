<div class="row">
    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Kode Negara"
            name="kode_negara"
            placeholder="Contoh: id"
            hint="Kode ISO 2 huruf (huruf kecil), dipakai untuk ikon bendera."
            :value="$misiAsingAsean->kode_negara ?? null" />
    </div>

    <div class="col-lg-9 mb-3">
        <x-form-input-text
            label="Nama Negara"
            name="nama_negara"
            placeholder="Contoh: Indonesia"
            :value="$misiAsingAsean->nama_negara ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Nama Misi (ID)"
            name="nama_misi_asing_asean_id"
            :value="$misiAsingAsean->nama_misi_asing_asean_id ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Nama Misi (EN)"
            name="nama_misi_asing_asean_en"
            :value="$misiAsingAsean->nama_misi_asing_asean_en ?? null" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-text
            label="Nama Diplomat"
            name="nama_diplomat"
            :value="$misiAsingAsean->nama_diplomat ?? null" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Format Undangan"
            name="format_undangan"
            rows="5"
            :value="$misiAsingAsean->format_undangan ?? null" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-text
            label="Alamat"
            name="alamat"
            :value="$misiAsingAsean->alamat ?? null" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Kelurahan"
            name="kelurahan"
            :value="$misiAsingAsean->kelurahan ?? null" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Kecamatan"
            name="kecamatan"
            :value="$misiAsingAsean->kecamatan ?? null" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Kota"
            name="kota"
            :value="$misiAsingAsean->kota ?? null" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Kode Pos"
            name="kode_pos"
            :value="$misiAsingAsean->kode_pos ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Telepon Kantor"
            name="telepon_kantor"
            placeholder="Contoh: 021-1234567, 021-7654321"
            hint="Pisahkan dengan koma jika lebih dari satu nomor."
            :value="$misiAsingAsean->telepon_kantor ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Email Kantor"
            name="email_kantor"
            placeholder="Contoh: info@misi.org, protokol@misi.org"
            hint="Pisahkan dengan koma jika lebih dari satu email."
            :value="$misiAsingAsean->email_kantor ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('misi-asing-asean.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
