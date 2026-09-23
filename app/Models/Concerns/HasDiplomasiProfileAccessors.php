<?php

// app/Models/Concerns/HasDiplomasiProfileAccessors.php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

/**
 * Accessor tampilan yang dipakai bersama oleh 5 modul Riwayat Diplomasi
 * (Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan). Pasangan trait
 * ini di sisi Mitra adalah HasMitraProfileAccessors.
 *
 * Model yang memakai trait ini WAJIB punya kolom/property berikut:
 *
 * @property-read Carbon|null $tanggal_diterima
 * @property-read Carbon|null $tanggal_selesai
 * @property string $statusColumn Nama kolom status pada model ini, mis. 'status_kerjasama'
 * @property string $judulColumn Nama kolom judul pada model ini, mis. 'kerjasama'
 */
trait HasDiplomasiProfileAccessors
{
    /**
     * Nama kolom judul & status milik model ini, dibuka ke publik supaya
     * App\Enums\ModulDiplomasi bisa meneruskannya tanpa menyalin daftarnya.
     *
     * Kolom judul TIDAK selalu senama dengan modulnya — `tb_undangan.acara`,
     * `tb_audiensi.topik`, `tb_kunjungan.perihal` — jadi menebak namanya dari
     * nama modul adalah sumber bug yang nyata.
     */
    public function kolomJudul(): string
    {
        return $this->judulColumn;
    }

    public function kolomStatus(): string
    {
        return $this->statusColumn;
    }

    protected function statusBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->{$this->statusColumn}) {
                'Berjalan' => 'bg-blue-lt',
                'Selesai' => 'bg-success-lt',
                'Tunda' => 'bg-warning-lt',
                'Batal' => 'bg-danger-lt',
                'Regret' => 'bg-secondary-lt',
                default => 'bg-secondary-lt',
            },
        );
    }

    protected function judulRingkas(): Attribute
    {
        return Attribute::make(
            get: fn () => str($this->{$this->judulColumn})->stripTags()->limit(100)->toString(),
        );
    }

    protected function tanggalDiterimaDisplay(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_diterima?->format('d M Y') ?? '-',
        );
    }

    protected function tanggalSelesaiDisplay(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_selesai
                ? $this->tanggal_selesai->format('d M Y')
                : '<span class="text-danger">Masih Berjalan</span>',
        );
    }

    /**
     * Nilai tanggal berformat ISO (`Y-m-d`) untuk atribut `data-order` DataTables
     * pada index.blade.php — *_display di atas memformat tanggal sebagai
     * "d M Y" (mis. "02 Jul 2026") yang salah urut kalau disortir DataTables
     * apa adanya (angka tanggal di depan dibaca duluan, bulan & tahun
     * terabaikan). DataTables otomatis memakai `data-order` untuk pengurutan
     * tanpa mengubah tampilan sel.
     */
    protected function tanggalDiterimaOrder(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_diterima?->format('Y-m-d') ?? '',
        );
    }

    /**
     * Sama seperti tanggalDiterimaOrder() di atas, untuk kolom Tanggal Selesai.
     * Baris yang "Masih Berjalan" (belum ada tanggal selesai) diberi string
     * kosong supaya selalu berada di ujung urutan tanggal, bukan tercampur di
     * tengah data yang sudah selesai.
     */
    protected function tanggalSelesaiOrder(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_selesai?->format('Y-m-d') ?? '',
        );
    }
}
