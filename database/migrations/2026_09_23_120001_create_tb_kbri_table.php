<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kedutaan Besar Republik Indonesia di luar negeri. Tabel terpisah dari
     * tb_kedutaan_besar (yang mencatat kedutaan besar NEGARA ASING di Jakarta)
     * karena keduanya jenis mitra yang berbeda pada tb_mitra.
     *
     * Skema mengikuti pola "nama + keterangan" seperti
     * tb_non_perwakilan_negara_asing.
     */
    public function up(): void
    {
        Schema::create('tb_kbri', function (Blueprint $table) {

            // primary key mandiri
            $table->id('id_kbri');

            // foreign key terpisah ke tb_mitra (unique -> menjamin relasi 1:1 ke tb_mitra)
            $table->foreignId('id_mitra')->unique()->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();

            // columns-columns
            $table->string('nama_kbri');
            $table->text('keterangan')->nullable();

            // status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_kbri');
    }
};
