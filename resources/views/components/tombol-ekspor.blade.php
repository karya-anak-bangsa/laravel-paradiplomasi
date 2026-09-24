{{-- $modul: case App\Enums\ModulDiplomasi atau App\Enums\TipeMitra — keduanya punya urlEkspor() --}}
@props(['modul'])

@php
    // Filter yang sedang aktif ikut dibawa ke tombol ekspor, supaya isi file
    // sama dengan tabel yang sedang dilihat. Index mitra tidak punya filter.
    $filterAktif = array_filter(request()->only(['status', 'tahun']));
    $keterangan = $modul instanceof \App\Enums\TipeMitra ? 'Seluruh mitra aktif' : 'Sesuai filter yang aktif';
@endphp

<div class="dropdown">
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
        <i class="fa-solid fa-download me-2"></i>Ekspor
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <span class="dropdown-header">{{ $keterangan }}</span>
        <a class="dropdown-item" href="{{ $modul->urlEkspor('excel', $filterAktif) }}">
            <i class="fa-solid fa-file-excel text-green me-2"></i>Excel (.xlsx)
        </a>
        <a class="dropdown-item" href="{{ $modul->urlEkspor('pdf', $filterAktif) }}">
            <i class="fa-solid fa-file-pdf text-red me-2"></i>PDF (.pdf)
        </a>
    </div>
</div>
