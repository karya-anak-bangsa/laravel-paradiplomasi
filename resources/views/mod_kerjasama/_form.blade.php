<div class="mb-4">
    <label for="id_kedutaan_besar" class="form-label">Nama Negara</label>
    <select class="form-select border-dark" name="id_kedutaan_besar" id="id_kedutaan_besar">
        <option value="" selected></option>
        <option value="Amerika Serikat">Amerika Serikat</option>
        <option value="Inggris">Inggris</option>
        <option value="Jepang">Jepang</option>
    </select>
    {{-- Hanya contoh, saya ingin selectbox dibuat lebih otomatis yaitu dapat membaca nama-nama negara di tb_kedutaan_besar --}}
    {{-- Namun, nilai yang tersimpan adalah id_kedutaan_besar --}}
</div>

<div class="mb-4">
    <label for="kerjasama" class="form-label">Kerjasama</label>
    <textarea class="form-control border-dark" name="kerjasama" id="kerjasama" rows="10"></textarea>
    {{-- Saat ini textarea tanpa wysiwyg --}}
</div>

<div class="mb-4">
    <label for="rangkuman" class="form-label">Rangkuman</label>
    <textarea class="form-control border-dark" name="rangkuman" id="rangkuman" rows="10"></textarea>
</div>

<div class="mb-4">
    <label for="catatan" class="form-label">Catatan</label>
    <textarea class="form-control border-dark" name="catatan" id="catatan" rows="10"></textarea>
    <small class="text-danger">Harap masukan link dokumen dibagian catatan</small>
</div>

<div class="row mb-4">
    <div class="col-lg-6">
        <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
        <input class="form-control border-dark" type="date" name="tanggal_diterima" id="tanggal_diterima">
    </div>
    <div class="col-lg-6">
        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
        <input class="form-control border-dark" type="date" name="tanggal_selesai" id="tanggal_selesai">
        <small class="text-danger">Jika kerjasama masih berjalan, harap kosongkan tanggal selesai.</small>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-6">
        <label for="triwulan_kerjasama" class="form-label">Triwulan Kerjasama</label>
        <select class="form-select border-dark" name="triwulan_kerjasama" id="triwulan_kerjasama">
            <option value="" selected></option>
            <option value="TW I">TW I</option>
            <option value="TW II">TW II</option>
            <option value="TW III">TW III</option>
            <option value="TW IV">TW IV</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label for="status_kerjasama" class="form-label">Status Kerjasama</label>
        <select class="form-select border-dark" name="status_kerjasama" id="status_kerjasama">
            <option value="" selected></option>
            <option value="Berjalan">Berjalan</option>
            <option value="Selesai">Selesai</option>
            <option value="Tunda">Tunda</option>
            <option value="Batal">Batal</option>
            <option value="Regret">Regret</option>
        </select>
    </div>
</div>

<div class="mb-4">
    <button type="button" class="btn btn-secondary">
        <i class="fa-solid fa-rotate-left me-2"></i>Kembali
    </button>
    <button type="button" class="btn btn-success">
        <i class="fa-solid fa-save me-2"></i>Simpan
    </button>
    {{-- Hanya contoh, saya tahu jika button menggunakan type submit --}}
</div>
