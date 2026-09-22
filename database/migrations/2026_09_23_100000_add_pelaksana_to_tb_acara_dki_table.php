<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_acara_dki', function (Blueprint $table) {
            $table->string('pelaksana')->nullable()->after('id_mitra');
        });
    }

    public function down(): void
    {
        Schema::table('tb_acara_dki', function (Blueprint $table) {
            $table->dropColumn('pelaksana');
        });
    }
};
