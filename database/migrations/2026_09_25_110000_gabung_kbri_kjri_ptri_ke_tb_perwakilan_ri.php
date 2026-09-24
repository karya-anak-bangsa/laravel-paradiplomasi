<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Gabungkan tiga subtype mitra — KBRI, KJRI, PTRI — menjadi satu subtype
     * "Perwakilan RI di Luar Negeri" (arahan Kasubag, 25 Sep 2026). Jenisnya
     * kini dicatat di kolom tipe_perwakilan_ri.
     *
     * id_mitra setiap baris TIDAK berubah — yang pindah hanya baris subtype-
     * nya, lalu tipe_mitra pada tb_mitra disesuaikan. Seluruh Riwayat Diplomasi
     * yang menunjuk ke mitra tersebut tetap tersambung tanpa perlu disentuh.
     * Baris yang sudah dihapus (deleted_at terisi) ikut dipindah apa adanya,
     * supaya tetap bisa dipulihkan lewat Restore Data.
     *
     * Sengaja memakai query builder dan nilai literal, bukan model/enum:
     * migration harus tetap bisa dijalankan walau model/enum-nya kelak berubah.
     */
    private const TIPE_MITRA_BARU = 'Perwakilan RI di Luar Negeri';

    /**
     * Tabel lama => [kode tipe_perwakilan_ri, tipe_mitra lama].
     */
    private const ASAL = [
        'kbri' => ['KBRI', 'Kedutaan Besar Republik Indonesia (KBRI)'],
        'kjri' => ['KJRI', 'Konsulat Jenderal Republik Indonesia (KJRI)'],
        'ptri' => ['PTRI', 'Perutusan Tetap Republik Indonesia (PTRI)'],
    ];

    public function up(): void
    {
        Schema::create('tb_perwakilan_ri', function (Blueprint $table) {

            // primary key mandiri
            $table->id('id_perwakilan_ri');

            // foreign key terpisah ke tb_mitra (unique -> menjamin relasi 1:1 ke tb_mitra)
            $table->foreignId('id_mitra')->unique()->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();

            // columns-columns
            $table->string('nama_perwakilan_ri');
            $table->string('tipe_perwakilan_ri');
            $table->text('keterangan')->nullable();

            // status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::transaction(function () {
            foreach (self::ASAL as $asal => [$kode, $tipeMitraLama]) {
                $daftar = DB::table("tb_{$asal}")->orderBy("id_{$asal}")->get();

                foreach ($daftar as $baris) {
                    DB::table('tb_perwakilan_ri')->insert([
                        'id_mitra' => $baris->id_mitra,
                        'nama_perwakilan_ri' => $baris->{"nama_{$asal}"},
                        'tipe_perwakilan_ri' => $kode,
                        'keterangan' => $baris->keterangan,
                        'is_active' => $baris->is_active,
                        'created_at' => $baris->created_at,
                        'updated_at' => $baris->updated_at,
                        'deleted_at' => $baris->deleted_at,
                    ]);
                }

                DB::table('tb_mitra')
                    ->where('tipe_mitra', $tipeMitraLama)
                    ->update(['tipe_mitra' => self::TIPE_MITRA_BARU]);
            }
        });

        foreach (array_keys(self::ASAL) as $asal) {
            Schema::dropIfExists("tb_{$asal}");
        }
    }

    public function down(): void
    {
        foreach (array_keys(self::ASAL) as $asal) {
            Schema::create("tb_{$asal}", function (Blueprint $table) use ($asal) {
                $table->id("id_{$asal}");
                $table->foreignId('id_mitra')->unique()->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();
                $table->string("nama_{$asal}");
                $table->text('keterangan')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        DB::transaction(function () {
            foreach (self::ASAL as $asal => [$kode, $tipeMitraLama]) {
                $daftar = DB::table('tb_perwakilan_ri')
                    ->where('tipe_perwakilan_ri', $kode)
                    ->orderBy('id_perwakilan_ri')
                    ->get();

                foreach ($daftar as $baris) {
                    DB::table("tb_{$asal}")->insert([
                        'id_mitra' => $baris->id_mitra,
                        "nama_{$asal}" => $baris->nama_perwakilan_ri,
                        'keterangan' => $baris->keterangan,
                        'is_active' => $baris->is_active,
                        'created_at' => $baris->created_at,
                        'updated_at' => $baris->updated_at,
                        'deleted_at' => $baris->deleted_at,
                    ]);
                }

                DB::table('tb_mitra')
                    ->whereIn('id_mitra', $daftar->pluck('id_mitra'))
                    ->update(['tipe_mitra' => $tipeMitraLama]);
            }
        });

        Schema::dropIfExists('tb_perwakilan_ri');
    }
};
