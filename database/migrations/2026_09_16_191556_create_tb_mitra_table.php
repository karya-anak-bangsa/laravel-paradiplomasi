<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel identitas (supertype) untuk pola generalisasi-spesialisasi.
     * Setiap mitra Biro KSD — apapun jenisnya — WAJIB punya satu baris di sini,
     * dibuat OTOMATIS oleh trait BelongsToMitra saat record anak (Kedutaan Besar,
     * Misi Asing ASEAN, dst) dibuat. Baris di sini TIDAK PERNAH diisi manual/di-seed.
     */
    public function up(): void
    {
        Schema::create('tb_mitra', function (Blueprint $table) {

            // primary key
            $table->id('id_mitra');

            // columns-columns
            $table->string('tipe_mitra');

            // status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_mitra');
    }
};
