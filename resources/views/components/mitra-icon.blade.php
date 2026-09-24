@props(['mitra', 'size' => 'md'])

{{--
    Penanda visual mitra: bendera negara untuk perwakilan negara asing di Jakarta,
    ikon generik untuk mitra yang hanya mencatat nama (Kantor Dagang Asing, Pusat
    Kebudayaan Asing, Perwakilan RI, Pemprov DKI, Non-PNA). Pembedanya diambil
    dari TipeMitra::berbasisNegara(), bukan dari daftar tipe yang ditulis ulang
    di sini.
--}}

@php
    $height = match ($size) {
        'xs' => '1.25rem',
        'sm' => '2rem',
        'lg' => '3rem',
        'xl' => '5rem',
        default => '2.5rem',
    };
@endphp

@if ($mitra->tipe_mitra?->berbasisNegara())
    <span class="flag flag-{{ $size }} flag-country-{{ $mitra->kode_mitra }} me-2"></span>
@else
    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white me-2"
        style="height: {{ $height }}; aspect-ratio: 1.33333; border-radius: var(--tblr-border-radius); box-shadow: var(--tblr-shadow-border);">
        <i class="fa-solid fa-landmark"></i>
    </span>
@endif
