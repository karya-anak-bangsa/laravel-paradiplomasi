<?php

namespace App\Models\Concerns;

/**
 * Konstanta opsi dropdown yang dipakai bersama oleh 5 modul Riwayat Diplomasi
 * (Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan) — dipakai di form
 * create/edit (mis. `HasDiplomasiFieldOptions::STATUS_OPTIONS`).
 *
 * Dipisah dari accessor tampilan (lihat HasDiplomasiProfileAccessors) karena
 * ini murni data konfigurasi field, bukan cara menampilkan data ke UI.
 */
trait HasDiplomasiFieldOptions
{
    public const TRIWULAN_OPTIONS = [
        'TW I'      => 'TW I',
        'TW II'     => 'TW II',
        'TW III'    => 'TW III',
        'TW IV'     => 'TW IV',
    ];

    public const STATUS_OPTIONS = [
        'Berjalan'  => 'Berjalan',
        'Selesai'   => 'Selesai',
        'Tunda'     => 'Tunda',
        'Batal'     => 'Batal',
        'Regret'    => 'Regret',
    ];
}
