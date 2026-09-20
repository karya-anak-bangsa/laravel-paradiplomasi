@props(['mitra', 'size' => 'md'])

@if ($mitra->tipe_mitra === \App\Enums\TipeMitra::NonPNA)
    <span class="avatar avatar-{{ $size }} bg-secondary-lt me-2"><i class="fa-solid fa-landmark"></i></span>
@else
    <span class="flag flag-{{ $size }} flag-country-{{ $mitra->kode_mitra }} me-2"></span>
@endif
