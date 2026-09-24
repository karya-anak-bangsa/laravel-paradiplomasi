<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Pindahkan Taipei Economic and Trade Office (TETO) dari Non Perwakilan
     * Negara Asing ke modul Kantor Dagang Asing yang baru dibuat.
     *
     * id_mitra-nya TIDAK berubah — yang pindah hanya baris subtype-nya, lalu
     * tipe_mitra pada tb_mitra disesuaikan. Dengan begitu seluruh Riwayat
     * Diplomasi yang menunjuk ke TETO (tb_undangan, tb_acara_dki_mitra, dst)
     * tetap tersambung tanpa perlu disentuh.
     *
     * Hanya berlaku untuk database yang sudah berjalan (lokal & Hostinger).
     * Pada migrate:fresh --seed tabelnya masih kosong saat migration ini jalan,
     * sehingga tidak melakukan apa-apa — TETO langsung di-seed lewat
     * KantorDagangAsingSeeder.
     *
     * Sengaja memakai query builder, bukan model: migration harus tetap bisa
     * dijalankan walau model/enum-nya kelak berubah.
     */
    private const NAMA = 'Taipei Economic and Trade Office (TETO)';

    public function up(): void
    {
        DB::transaction(function () {
            $baris = DB::table('tb_non_perwakilan_negara_asing')
                ->where('nama_non_perwakilan_negara_asing', self::NAMA)
                ->first();

            if ($baris === null) {
                return;
            }

            DB::table('tb_kantor_dagang_asing')->insert([
                'id_mitra' => $baris->id_mitra,
                'nama_kantor_dagang_asing' => $baris->nama_non_perwakilan_negara_asing,
                'keterangan' => $baris->keterangan,
                'is_active' => $baris->is_active,
                'created_at' => $baris->created_at,
                'updated_at' => $baris->updated_at,
                'deleted_at' => $baris->deleted_at,
            ]);

            DB::table('tb_mitra')
                ->where('id_mitra', $baris->id_mitra)
                ->update(['tipe_mitra' => 'Kantor Dagang Asing']);

            DB::table('tb_non_perwakilan_negara_asing')
                ->where('id_non_perwakilan_negara_asing', $baris->id_non_perwakilan_negara_asing)
                ->delete();
        });
    }

    public function down(): void
    {
        DB::transaction(function () {
            $baris = DB::table('tb_kantor_dagang_asing')
                ->where('nama_kantor_dagang_asing', self::NAMA)
                ->first();

            if ($baris === null) {
                return;
            }

            DB::table('tb_non_perwakilan_negara_asing')->insert([
                'id_mitra' => $baris->id_mitra,
                'nama_non_perwakilan_negara_asing' => $baris->nama_kantor_dagang_asing,
                'keterangan' => $baris->keterangan,
                'is_active' => $baris->is_active,
                'created_at' => $baris->created_at,
                'updated_at' => $baris->updated_at,
                'deleted_at' => $baris->deleted_at,
            ]);

            DB::table('tb_mitra')
                ->where('id_mitra', $baris->id_mitra)
                ->update(['tipe_mitra' => 'Non Perwakilan Negara Asing']);

            DB::table('tb_kantor_dagang_asing')
                ->where('id_kantor_dagang_asing', $baris->id_kantor_dagang_asing)
                ->delete();
        });
    }
};
