@props(['mitra'])

{{--
    Isi kanan header kartu "Riwayat Diplomasi" di halaman profil mitra (slot
    `actions` milik x-page-body-show): dropdown tahun + tombol Ekspor. Dipakai
    kedelapan halaman show mitra, berpasangan dengan x-mitra-riwayat.

    Prop $mitra: model subtype (KedutaanBesar/PerwakilanRi/dst) yang relasinya
    sudah dimuat controller lewat muatRiwayatDiplomasi().

    Memilih tahun memuat ulang halaman (GET ?tahun=) dan melompat kembali ke
    kartu ini (#riwayat-diplomasi). Tahun menyaring keenam tab SEKALIGUS file
    ekspornya — x-tombol-ekspor meneruskan ?tahun ke Mitra::urlEkspor(), dan
    kedua sisi memvalidasinya lewat saringTahunRiwayat(), jadi tahun yang
    tidak sah = semua tahun di layar maupun di file.
--}}

@php
    $daftarTahun = $mitra->tahunRiwayatDiplomasi();
    $tahun = $mitra->saringTahunRiwayat(request('tahun'));
@endphp

<div class="d-flex align-items-center gap-2" id="riwayat-diplomasi">
    <form method="GET" action="{{ url()->current() }}#riwayat-diplomasi">
        <select name="tahun" class="form-select" aria-label="Tahun riwayat diplomasi" autocomplete="off" onchange="this.form.submit()">
            <option value="" @selected($tahun === null)>Semua Tahun</option>
            @foreach ($daftarTahun as $pilihan)
                <option value="{{ $pilihan }}" @selected($tahun === $pilihan)>{{ $pilihan }}</option>
            @endforeach
        </select>
    </form>

    <x-tombol-ekspor :modul="$mitra->mitra" :judul="$tahun ? 'Riwayat Diplomasi Tahun '.$tahun : 'Seluruh Riwayat Diplomasi'" />
</div>
