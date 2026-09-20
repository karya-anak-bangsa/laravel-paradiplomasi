<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_acara_dki', function (Blueprint $table) {

            // primary key
            $table->id('id_acara_dki');

            // columns-columns
            $table->text('acara_dki')->nullable();
            $table->text('rangkuman')->nullable();
            $table->text('catatan')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_awal_pelaksanaan')->nullable();
            $table->date('tanggal_akhir_pelaksanaan')->nullable();
            $table->enum('triwulan_acara_dki', ['TW I', 'TW II', 'TW III', 'TW IV'])->default('TW I');
            $table->enum('status_acara_dki', ['Berjalan', 'Selesai', 'Tunda', 'Batal', 'Regret'])->default('Berjalan');

            // status data & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_acara_dki');
    }
};
