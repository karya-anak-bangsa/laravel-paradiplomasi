@props([
    'name' => 'id_mitra',
    'value' => null,
    'mitra' => null,
    'daftarMitra',
    'required' => true,
])

{{--
    Pemilih mitra dua tingkat: pilih tipe mitra dulu, baru nama mitranya.

    Seluruh isi dropdown diturunkan dari $daftarMitra (App\Support\DaftarMitra),
    yang sendirinya diturunkan dari enum App\Enums\TipeMitra. Komponen ini karena
    itu TIDAK menyebut satu pun jenis mitra secara hardcode — menambah jenis
    mitra baru tidak perlu menyentuh berkas ini.
--}}

@php
    $nilaiTerpilih = old($name, $value);
    $tipeAwal = $mitra?->tipe_mitra?->slug();
    $idTipe = 'tipe-mitra-pilihan-' . $name;
@endphp

<div class="col-lg-6 mb-3">
    <label class="form-label" for="{{ $idTipe }}">Tipe Mitra</label>
    <select class="form-select border-dark" id="{{ $idTipe }}">
        <option value="" selected>Pilih tipe mitra</option>
        @foreach ($daftarMitra as $slug => $tipe)
            <option value="{{ $slug }}">{{ $tipe['label'] }}</option>
        @endforeach
    </select>
    <small class="form-text">Pilih tipe mitra terlebih dahulu untuk menampilkan daftar mitranya.</small>
</div>

<div class="col-lg-6 mb-3">
    <label class="form-label" for="{{ $name }}">@if ($required)<span class="text-danger">*</span>@endif Nama Mitra</label>
    <select class="form-select border-dark" name="{{ $name }}" id="{{ $name }}" disabled>
        <option value="">Pilih tipe mitra terlebih dahulu</option>
    </select>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

@push('scripts')
    <script>
        (function() {
            const selectTipe = document.getElementById(@json($idTipe));
            const selectMitra = document.getElementById(@json($name));

            const daftarMitraPerTipe = @json(collect($daftarMitra)->map(fn ($tipe) => $tipe['opsi']));

            const $selectMitra = $(selectMitra);
            $selectMitra.select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Pilih tipe mitra terlebih dahulu',
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

            const tipeAwal = @json($tipeAwal);
            const nilaiAwal = @json($nilaiTerpilih !== null ? (string) $nilaiTerpilih : null);

            if (tipeAwal) {
                selectTipe.value = tipeAwal;
                terapkanTipe(tipeAwal, nilaiAwal);
            }
        })();
    </script>
@endpush
