<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_acara_dki_mitra', function (Blueprint $table) {

            // primary key
            $table->id('id_acara_dki_mitra');

            // relasi
            $table->foreignId('id_acara_dki')->constrained('tb_acara_dki', 'id_acara_dki')->cascadeOnDelete();
            $table->foreignId('id_mitra')->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();

            // status kehadiran mitra pada acara ini
            $table->enum('status_kehadiran', ['Diundang', 'Hadir', 'Tidak Hadir'])->default('Diundang');
            $table->text('keterangan_kehadiran')->nullable();

            $table->timestamps();

            $table->unique(['id_acara_dki', 'id_mitra']);
        });

        // pindahkan data id_mitra lama (1 mitra per acara) ke pivot sebagai "Hadir"
        DB::table('tb_acara_dki')
            ->whereNotNull('id_mitra')
            ->select('id_acara_dki', 'id_mitra')
            ->orderBy('id_acara_dki')
            ->chunkById(200, function ($rows) {
                $now = now();

                DB::table('tb_acara_dki_mitra')->insert(
                    $rows->map(fn ($row) => [
                        'id_acara_dki' => $row->id_acara_dki,
                        'id_mitra' => $row->id_mitra,
                        'status_kehadiran' => 'Hadir',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])->all()
                );
            }, 'id_acara_dki');

        Schema::table('tb_acara_dki', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_mitra');
        });
    }

    public function down(): void
    {
        Schema::table('tb_acara_dki', function (Blueprint $table) {
            $table->foreignId('id_mitra')->nullable()->after('id_acara_dki')->constrained('tb_mitra', 'id_mitra')->restrictOnDelete();
        });

        DB::table('tb_acara_dki_mitra')
            ->where('status_kehadiran', 'Hadir')
            ->orderBy('id_acara_dki')
            ->select('id_acara_dki', 'id_mitra')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('tb_acara_dki')
                        ->where('id_acara_dki', $row->id_acara_dki)
                        ->update(['id_mitra' => $row->id_mitra]);
                }
            }, 'id_acara_dki');

        Schema::dropIfExists('tb_acara_dki_mitra');
    }
};
