<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Perutusan Tetap Republik Indonesia pada organisasi internasional. Skema
     * mengikuti pola "nama + keterangan" seperti tb_non_perwakilan_negara_asing.
     */
    public function up(): void
    {
        Schema::create('tb_ptri', function (Blueprint $table) {

            // primary key mandiri
            $table->id('id_ptri');

            // foreign key terpisah ke tb_mitra (unique -> menjamin relasi 1:1 ke tb_mitra)
            $table->foreignId('id_mitra')->unique()->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();

            // columns-columns
            $table->string('nama_ptri');
            $table->text('keterangan')->nullable();

            // status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_ptri');
    }
};
