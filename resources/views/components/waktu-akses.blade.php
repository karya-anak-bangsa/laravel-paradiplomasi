@props(['label' => 'Diakses pada'])

{{-- Jam akses halaman dalam WIB. Aplikasi berjalan dalam UTC, jadi jangan
     menulis now()->format(...) polos di view — lihat App\Support\Waktu. --}}
{{ $label }} {{ \App\Support\Waktu::sekarang()->format('d M Y, H:i') }} WIB
