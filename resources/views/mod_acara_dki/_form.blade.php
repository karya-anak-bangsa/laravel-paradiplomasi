<div class="row">
    <div class="col-lg-12 mb-3">
        <x-form-input-text
            label="Pelaksana"
            name="pelaksana"
            hint="Biro/instansi Pemda DKI yang menyelenggarakan acara ini."
            :value="$acaraDki->pelaksana ?? null"
            :required="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <label class="form-label">Mitra yang Diundang</label>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-2">
                <thead>
                    <tr>
                        <th style="width:20%">Tipe Mitra</th>
                        <th style="width:25%">Nama Mitra</th>
                        <th style="width:15%">Status Kehadiran</th>
                        <th style="width:30%">Keterangan</th>
                        <th style="width:10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="baris-mitra-acara-dki"></tbody>
            </table>
        </div>
        <button type="button" id="tambah-baris-mitra" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-plus me-1"></i>Tambah Mitra
        </button>
        <div class="form-hint mt-2">
            Boleh dikosongkan — mis. acara yang dibatalkan/ditunda sehingga tidak dihadiri mitra manapun,
            atau data undangannya belum dikurasi.
        </div>
        @error('mitra')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        @if ($errors->keys())
            @php $errorMitra = collect($errors->keys())->filter(fn ($key) => str($key)->startsWith('mitra.')); @endphp
            @if ($errorMitra->isNotEmpty())
                <div class="alert alert-danger mt-2 mb-0">
                    <strong>Periksa kembali data mitra pada baris berikut:</strong>
                    <ul class="mb-0">
                        @foreach ($errorMitra as $key)
                            <li>{{ $errors->first($key) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Acara DKI"
            name="acara_dki"
            rows="10"
            :value="$acaraDki->acara_dki ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            hint="Ringkasan/deskripsi acara, bukan daftar tamu undangan."
            :value="$acaraDki->rangkuman ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$acaraDki->catatan ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($acaraDki->tanggal_diterima ?? null)->format('Y-m-d')"
            :required="true" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika acara masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($acaraDki->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Tanggal Awal Pelaksanaan"
            name="tanggal_awal_pelaksanaan"
            type="date"
            :value="optional($acaraDki->tanggal_awal_pelaksanaan ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Tanggal Akhir Pelaksanaan"
            name="tanggal_akhir_pelaksanaan"
            type="date"
            :value="optional($acaraDki->tanggal_akhir_pelaksanaan ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Triwulan Acara DKI"
            name="triwulan_acara_dki"
            hint="Periode triwulan saat acara DKI ini diterima/dicatat."
            :options="\App\Models\AcaraDKI::TRIWULAN_OPTIONS"
            :value="$acaraDki->triwulan_acara_dki ?? null"
            :required="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Acara DKI"
            name="status_acara_dki"
            :options="\App\Models\AcaraDKI::STATUS_OPTIONS"
            :value="$acaraDki->status_acara_dki ?? null"
            :required="true" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('acara-dki.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>

<script type="text/template" id="template-baris-mitra-acara-dki">
<tr class="baris-mitra">
    <td>
        <select class="form-select border-dark tipe-mitra-baris">
            <option value="" selected>Pilih tipe mitra</option>
            @foreach ($daftarMitra as $slug => $tipe)
                <option value="{{ $slug }}">{{ $tipe['label'] }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-select border-dark nama-mitra-baris" name="mitra[__INDEX__][id_mitra]" disabled>
            <option value="">Pilih tipe mitra terlebih dahulu</option>
        </select>
    </td>
    <td>
        <select class="form-select border-dark" name="mitra[__INDEX__][status_kehadiran]">
            @foreach (\App\Models\AcaraDkiMitra::STATUS_KEHADIRAN_OPTIONS as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="text" class="form-control border-dark" name="mitra[__INDEX__][keterangan_kehadiran]" placeholder="Keterangan (opsional)">
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-icon btn-danger hapus-baris-mitra"><i class="fa-solid fa-trash"></i></button>
    </td>
</tr>
</script>

@php
    // saat submit gagal validasi, sisipan mitra yang sudah diisi user harus
    // dipertahankan (bukan direset ke data lama di database) — id_mitra dari
    // old input dicocokkan balik ke tipe mitranya lewat daftar mitra aktif
    // yang sama dengan yang dipakai untuk opsi dropdown di bawah.
    $tipeMitraByIdMitra = collect($daftarMitra)
        ->flatMap(fn ($tipe, $slug) => collect($tipe['opsi'])->mapWithKeys(fn ($opsi) => [$opsi['id'] => $slug]));

    $mitraLama = collect(old('mitra'));

    $mitraTerpilihAwal = $mitraLama->isNotEmpty()
        ? $mitraLama->map(fn ($row) => [
            'tipe' => $tipeMitraByIdMitra->get((string) ($row['id_mitra'] ?? null)),
            'idMitra' => $row['id_mitra'] ?? null,
            'status' => $row['status_kehadiran'] ?? 'Diundang',
            'keterangan' => $row['keterangan_kehadiran'] ?? null,
        ])->values()
        : (isset($acaraDki)
            ? $acaraDki->mitra->map(fn ($mitra) => [
                'tipe' => $mitra->tipe_mitra?->slug(),
                'idMitra' => $mitra->id_mitra,
                'status' => $mitra->pivot->status_kehadiran,
                'keterangan' => $mitra->pivot->keterangan_kehadiran,
            ])->values()
            : collect());
@endphp

@push('scripts')
    <script>
        (function() {
            const tbody = document.getElementById('baris-mitra-acara-dki');
            const templateHtml = document.getElementById('template-baris-mitra-acara-dki').innerHTML;
            const tombolTambah = document.getElementById('tambah-baris-mitra');
            let indexBaris = 0;

            const daftarMitraPerTipe = @json(collect($daftarMitra)->map(fn ($tipe) => $tipe['opsi']));

            function pasangEventBaris(baris) {
                const selectTipe = baris.querySelector('.tipe-mitra-baris');
                const selectMitraEl = baris.querySelector('.nama-mitra-baris');
                const tombolHapus = baris.querySelector('.hapus-baris-mitra');

                const $selectMitra = $(selectMitraEl);
                $selectMitra.select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    placeholder: 'Pilih tipe mitra terlebih dahulu',
                    // dropdown dipasang ke <body>, bukan ke dalam .table-responsive,
                    // supaya tidak terpotong oleh overflow-x:auto pada tabel.
                    dropdownParent: $(document.body),
                });

                function terapkanTipe(tipe, nilaiTerpilih) {
                    $selectMitra.empty();
                    (daftarMitraPerTipe[tipe] || []).forEach(function(opsi) {
                        $selectMitra.append(new Option(opsi.text, opsi.id, false, false));
                    });
                    $selectMitra.prop('disabled', !tipe);
                    $selectMitra.val(nilaiTerpilih || null).trigger('change');
                }

                selectTipe.addEventListener('change', function() {
                    terapkanTipe(this.value, null);
                });

                // baris terakhir pun boleh dihapus: acara tanpa mitra sama sekali
                // adalah kondisi yang sah (lihat hint di bawah tabel).
                tombolHapus.addEventListener('click', function() {
                    $selectMitra.select2('destroy');
                    baris.remove();
                });

                return {
                    selectTipe,
                    terapkanTipe
                };
            }

            function tambahBaris(data) {
                const html = templateHtml.replaceAll('__INDEX__', indexBaris);
                const pembungkus = document.createElement('tbody');
                pembungkus.innerHTML = html.trim();
                const baris = pembungkus.querySelector('tr');
                tbody.appendChild(baris);

                const {
                    selectTipe,
                    terapkanTipe
                } = pasangEventBaris(baris);

                if (data) {
                    selectTipe.value = data.tipe;
                    terapkanTipe(data.tipe, data.idMitra);
                    baris.querySelector('[name$="[status_kehadiran]"]').value = data.status;
                    baris.querySelector('[name$="[keterangan_kehadiran]"]').value = data.keterangan ?? '';
                }

                indexBaris++;
            }

            tombolTambah.addEventListener('click', function() {
                tambahBaris(null);
            });

            const dataAwal = @json($mitraTerpilihAwal);
            const formTambah = @json(! isset($acaraDki));

            if (dataAwal.length) {
                dataAwal.forEach(tambahBaris);
            } else if (formTambah) {
                // hanya di halaman tambah satu baris kosong disediakan otomatis;
                // di halaman ubah, acara yang memang tidak punya mitra ditampilkan
                // apa adanya sebagai tabel kosong.
                tambahBaris(null);
            }
        })();
    </script>
@endpush
