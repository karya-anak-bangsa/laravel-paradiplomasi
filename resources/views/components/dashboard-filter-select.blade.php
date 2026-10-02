{{--
    Dropdown filter di kanan header kartu dashboard.

    Tiap kartu punya parameter query sendiri (`name`), jadi filter antar-kartu
    independen. Perubahan pilihan ditangani skrip di dashboard-ajax.blade.php:
    hanya kartu `anchor` yang diganti, tanpa refresh dan tanpa loncat scroll.
    Pilihan kartu lain dibaca dari URL, jadi tidak perlu form maupun hidden input.

    Props:
    - name   : nama parameter query, mis. `tahun_akumulasi`
    - options: [nilai => label] pilihan selain opsi "semua"
    - anchor : id kartu pemilik dropdown (kartu yang diganti saat pilihan berubah)
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

{{-- me-0: .card-actions bawaan Tabler bermargin kanan -0.5rem (untuk tombol), sehingga
     dropdown menjorok ke luar; dengan me-0 ujung kanannya sejajar dengan isi card-body. --}}
<div class="card-actions me-0 {{ $lebar }}">
    <select name="{{ $name }}" class="form-select" aria-label="{{ $semua }}" autocomplete="off" data-dashboard-filter data-kartu="{{ $anchor }}">
        <option value="" @selected($terpilih === null)>{{ $semua }}</option>
        @foreach ($options as $nilai => $label)
            <option value="{{ $nilai }}" @selected($terpilih === (string) $nilai)>{{ $label }}</option>
        @endforeach
    </select>
</div>
