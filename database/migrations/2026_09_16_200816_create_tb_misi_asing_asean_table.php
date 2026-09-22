<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_misi_asing_asean', function (Blueprint $table) {

            // primary key mandiri
            $table->id('id_misi_asing_asean');

            // foreign key terpisah ke tb_mitra (unique -> menjamin relasi 1:1 ke tb_mitra)
            $table->foreignId('id_mitra')->unique()->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();

            // columns-columns (sumber: sheet "Misi Asing untuk ASEAN")
            $table->string('kode_negara');
            $table->string('nama_negara');
            $table->string('nama_misi_asing_asean_id');
            $table->string('nama_misi_asing_asean_en');
            $table->text('format_undangan')->nullable();
            $table->string('nama_diplomat')->nullable();
            $table->text('email_kantor')->nullable();
            $table->text('telepon_kantor')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('website')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_misi_asing_asean');
    }
};
