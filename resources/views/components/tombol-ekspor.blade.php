@props(['modul'])

@php
    // Filter yang sedang aktif ikut dibawa ke tombol ekspor, supaya isi file
    // sama dengan tabel yang sedang dilihat.
    $filterAktif = array_filter(request()->only(['status', 'tahun']));
@endphp

<div class="dropdown">
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
        <i class="fa-solid fa-download me-2"></i>Ekspor
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <span class="dropdown-header">Sesuai filter yang aktif</span>
        <a class="dropdown-item" href="{{ route('ekspor.excel', ['modul' => $modul->slug(), ...$filterAktif]) }}">
            <i class="fa-solid fa-file-excel text-green me-2"></i>Excel (.xlsx)
        </a>
        <a class="dropdown-item" href="{{ route('ekspor.pdf', ['modul' => $modul->slug(), ...$filterAktif]) }}">
            <i class="fa-solid fa-file-pdf text-red me-2"></i>PDF (.pdf)
        </a>
    </div>
</div>
