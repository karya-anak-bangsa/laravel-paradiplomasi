<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ganti teks placeholder kolom `catatan` di 6 modul Riwayat Diplomasi
     * menjadi tanda strip, sesuai perubahan seeder (arahan user, 2 Okt 2026).
     *
     * Seeder dipakai untuk instalasi baru; migration ini untuk database yang
     * sudah berjalan (lokal & Hostinger), yang tidak boleh di-seed ulang
     * karena seeder memakai create() (data jadi dobel).
     *
     * Hanya baris yang catatannya masih persis sama dengan placeholder lama
     * yang diubah, sehingga catatan sungguhan yang sudah diisi admin tidak
     * tertimpa. Pada migrate:fresh --seed tabelnya masih kosong saat
     * migration ini jalan, sehingga tidak melakukan apa-apa.
     */
    private const PLACEHOLDER_LAMA = [
        'tb_kerjasama' => ['Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kerjasama', '-'],
        'tb_kolaborasi' => ['Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi', '-'],
        'tb_undangan' => ['Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan', '-'],
        'tb_audiensi' => ['Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi', '-'],
        'tb_kunjungan' => ['Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan', '-'],
        // Catatan Acara DKI berupa HTML dari editor teks kaya.
        'tb_acara_dki' => ['<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>', '<p>-</p>'],
    ];

    public function up(): void
    {
        foreach (self::PLACEHOLDER_LAMA as $tabel => [$lama, $baru]) {
            DB::table($tabel)->where('catatan', $lama)->update(['catatan' => $baru]);
        }
    }

    /**
     * Sengaja tidak mengembalikan teks placeholder lama: strip bisa saja
     * diketik admin sendiri, sehingga tidak ada cara aman membedakannya.
     */
    public function down(): void
    {
        //
    }
};
