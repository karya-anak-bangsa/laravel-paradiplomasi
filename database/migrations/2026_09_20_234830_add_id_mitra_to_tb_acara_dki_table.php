<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_acara_dki', function (Blueprint $table) {
            $table->foreignId('id_mitra')->after('id_acara_dki')->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tb_acara_dki', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_mitra');
        });
    }
};
