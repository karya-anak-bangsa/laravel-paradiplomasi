<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Tabel identitas (supertype) untuk pola generalisasi-spesialisasi (Party Pattern).
     * Setiap mitra Biro KSD — apapun jenisnya (Kedutaan Besar, Misi Asing untuk ASEAN,
     * Misi Permanen Negara ASEAN, dst di masa depan) — WAJIB punya satu baris di sini
     * dahulu. Tabel spesifik masing-masing (tb_kedutaan_besar, tb_misi_asing_asean,
     * tb_misi_permanen_asean) tetap punya primary key sendiri (auto-increment mandiri,
     * tidak berubah dari struktur sebelumnya) dan menyimpan id_mitra sebagai foreign key
     * terpisah (unique) ke tabel ini — bukan shared primary key — supaya kode existing
     * yang sudah keying ke id_kedutaan_besar (route, controller, view) tidak perlu diubah.
     * 5 modul riwayat (Kerjasama s.d. Kunjungan) merujuk langsung ke tb_mitra.id_mitra.
     */

    public function up(): void
    {
        Schema::create('tb_mitra', function (Blueprint $table) {

            # primary key
            $table->id('id_mitra');

            # columns-columns
            $table->string('tipe_mitra');

            # status data & timestamps
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
