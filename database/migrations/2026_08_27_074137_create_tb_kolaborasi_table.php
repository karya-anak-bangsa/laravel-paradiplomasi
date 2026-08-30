<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_kolaborasi', function (Blueprint $table) {

            # primary key dan foreign key
            $table->id('id_kolaborasi');
            $table->unsignedBigInteger('id_kedutaan_besar');
            $table->foreign('id_kedutaan_besar')->references('id_kedutaan_besar')->on('tb_kedutaan_besar')->restrictOnDelete();

            # columns-columns
            $table->text('kolaborasi')->nullable();
            $table->text('rangkuman')->nullable();
            $table->text('catatan')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->enum('triwulan_kolaborasi', ['TW I', 'TW II', 'TW III', 'TW IV'])->default('TW I');
            $table->enum('status_kolaborasi', ['Berjalan', 'Selesai', 'Batal'])->default('Berjalan');
            $table->string('nama_pic')->nullable();
            $table->string('nomor_pic')->nullable();

            # status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_kolaborasi');
    }
};
