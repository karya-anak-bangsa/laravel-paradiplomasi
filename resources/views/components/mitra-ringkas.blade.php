@props(['mitra'])

{{--
    Blok identitas mitra di dalam modal rincian Riwayat Diplomasi.

    Prop $mitra adalah model Mitra (supertype), bukan subtype-nya. Baris "Nama
    Resmi" hanya ditampilkan untuk mitra berbasis negara — pada mitra lain,
    label utamanya memang sudah nama resmi itu sendiri, jadi menampilkannya dua
    kali cuma mengulang.
--}}

<div class="hr-text hr-text-start">Mitra</div>
<div class="datagrid align-items-center mb-3">
    <div class="datagrid-item">
        <div class="datagrid-content d-flex align-items-center">
            <x-mitra-icon :mitra="$mitra" size="md" />
            <span class="fw-bold">{{ $mitra->label_mitra }}</span>
        </div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Tipe Mitra</div>
        <div class="datagrid-content">{{ $mitra->tipe_mitra?->value ?? '-' }}</div>
    </div>
    @if ($mitra->tipe_mitra?->berbasisNegara())
        <div class="datagrid-item">
            <div class="datagrid-title">Nama Resmi</div>
            <div class="datagrid-content">{{ $mitra->nama_resmi_mitra ?? '-' }}</div>
        </div>
    @endif
</div>
