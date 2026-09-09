<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_kedutaan_besar', function (Blueprint $table) {

            # primary key dan foreign key
            $table->id('id_kedutaan_besar');

            # columns-columns
            $table->string('kode_negara');
            $table->string('nama_negara');
            $table->string('nama_kedutaan_besar_id');
            $table->string('nama_kedutaan_besar_en');
            $table->text('format_undangan')->nullable();
            $table->string('nama_diplomat')->nullable();
            $table->string('jabatan_diplomat')->nullable();
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

            # status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_kedutaan_besar');
    }
};
