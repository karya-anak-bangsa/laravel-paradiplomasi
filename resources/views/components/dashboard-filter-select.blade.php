{{--
    Dropdown filter di kanan header kartu dashboard.

    Tiap kartu punya parameter query sendiri (`name`), jadi filter antar-kartu
    independen. Form-nya GET: pilihan kartu lain ikut dibawa lewat hidden
    input, dan fragmen `#anchor` pada action membuat halaman kembali ke kartu
    yang sedang diubah, bukan loncat ke atas.

    Props:
    - name   : nama parameter query, mis. `tahun_akumulasi`
    - options: [nilai => label] pilihan selain opsi "semua"
    - anchor : id kartu tujuan scroll setelah submit
    - semua  : label opsi bawaan (nilai kosong = tanpa filter)
    - lebar  : kelas grid pembungkus (default col-lg-2)
--}}
@props(['name', 'options' => [], 'anchor', 'semua' => 'Semua', 'lebar' => 'col-lg-2'])

@php
    // Tanpa parameter (atau nilai di luar daftar) berarti opsi "semua" — sama
    // dengan yang dipakai DashboardController saat menyaring data.
    $diminta = (string) request($name);
    $terpilih = $diminta !== '' && array_key_exists($diminta, $options) ? $diminta : null;
@endphp

<div class="card-actions {{ $lebar }}">
    <form method="GET" action="{{ route('dashboard.index') }}#{{ $anchor }}">
        @foreach (request()->except($name) as $kunci => $nilai)
            @if (is_scalar($nilai))
                <input type="hidden" name="{{ $kunci }}" value="{{ $nilai }}">
            @endif
        @endforeach

        <select name="{{ $name }}" class="form-select" aria-label="{{ $semua }}" autocomplete="off" onchange="this.form.submit()">
            <option value="" @selected($terpilih === null)>{{ $semua }}</option>
            @foreach ($options as $nilai => $label)
                <option value="{{ $nilai }}" @selected($terpilih === (string) $nilai)>{{ $label }}</option>
            @endforeach
        </select>
    </form>
</div>
