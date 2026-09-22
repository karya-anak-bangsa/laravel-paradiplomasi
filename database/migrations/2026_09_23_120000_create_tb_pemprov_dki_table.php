<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Perangkat daerah Pemerintah Provinsi DKI Jakarta (biro/dinas/badan) sebagai
     * mitra Biro KSD. Skemanya sengaja dibuat persis seperti
     * tb_non_perwakilan_negara_asing — hanya nama + keterangan — karena mitra
     * jenis ini tidak punya kode/nama negara, alamat, maupun koordinat.
     */
    public function up(): void
    {
        Schema::create('tb_pemprov_dki', function (Blueprint $table) {

            // primary key mandiri
            $table->id('id_pemprov_dki');

            // foreign key terpisah ke tb_mitra (unique -> menjamin relasi 1:1 ke tb_mitra)
            $table->foreignId('id_mitra')->unique()->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();

            // columns-columns
            $table->string('nama_pemprov_dki');
            $table->text('keterangan')->nullable();

            // status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pemprov_dki');
    }
};
