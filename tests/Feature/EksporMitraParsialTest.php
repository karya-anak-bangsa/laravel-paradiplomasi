<?php

namespace Tests\Feature;

use App\Enums\ModulDiplomasi;
use App\Enums\TipeMitra;
use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Support\EksporDiplomasi;
use App\Support\EksporMitra;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EksporMitraParsialTest extends TestCase
{
    use RefreshDatabase;

    private function buatKedutaan(string $negara): KedutaanBesar
    {
        return KedutaanBesar::create([
            'kode_negara' => strtolower(substr($negara, 0, 2)),
            'nama_negara' => $negara,
            'nama_kedutaan_besar_id' => 'Kedutaan Besar '.$negara,
            'nama_kedutaan_besar_en' => 'Embassy of '.$negara,
            'is_active' => true,
        ]);
    }

    public function test_tanpa_pilihan_seluruh_data_masuk_file(): void
    {
        foreach (['Australia', 'Belanda', 'Chile'] as $negara) {
            $this->buatKedutaan($negara);
        }

        $ekspor = new EksporMitra(TipeMitra::KedutaanBesar);

        $this->assertCount(3, $ekspor->baris());
        $this->assertSame('Seluruh mitra Biro KSD', $ekspor->keteranganFilter());
    }

    public function test_dengan_pilihan_hanya_data_terpilih_masuk_file_dan_urutan_tetap(): void
    {
        $australia = $this->buatKedutaan('Australia');
        $this->buatKedutaan('Belanda');
        $chile = $this->buatKedutaan('Chile');

        $ekspor = new EksporMitra(TipeMitra::KedutaanBesar, [$chile->getKey(), $australia->getKey()]);
        $baris = $ekspor->baris();

        $this->assertCount(2, $baris);
        $this->assertSame(['Australia', 'Chile'], array_column($baris, 'Negara'));
        $this->assertSame([1, 2], array_column($baris, 'No'));
        $this->assertSame('Mitra terpilih', $ekspor->keteranganFilter());
    }

    public function test_pilihan_tidak_bisa_memuat_data_nonaktif(): void
    {
        $australia = $this->buatKedutaan('Australia');
        $australia->update(['is_active' => false]);

        $ekspor = new EksporMitra(TipeMitra::KedutaanBesar, [$australia->getKey()]);

        $this->assertCount(0, $ekspor->baris());
    }

    public function test_endpoint_excel_dan_pdf_menerima_parameter_pilih(): void
    {
        $australia = $this->buatKedutaan('Australia');
        $this->buatKedutaan('Belanda');
        $sesi = ['auth_email' => 'admin@example.test', 'auth_role' => 'admin'];

        $this->withSession($sesi)
            ->get(route('ekspor.mitra.excel', ['tipe' => TipeMitra::KedutaanBesar->slug(), 'pilih' => (string) $australia->getKey()]))
            ->assertOk();

        $this->withSession($sesi)
            ->get(route('ekspor.mitra.pdf', ['tipe' => TipeMitra::KedutaanBesar->slug(), 'pilih' => (string) $australia->getKey()]))
            ->assertOk();
    }

    public function test_pilihan_rusak_ditolak_bukan_diam_diam_mengunduh_semua(): void
    {
        $this->buatKedutaan('Australia');

        $this->withSession(['auth_email' => 'admin@example.test', 'auth_role' => 'admin'])
            ->get(route('ekspor.mitra.excel', ['tipe' => TipeMitra::KedutaanBesar->slug(), 'pilih' => 'abc,;']))
            ->assertStatus(422);
    }

    public function test_index_menampilkan_checkbox_pilih_baris_dan_pilih_semua(): void
    {
        $australia = $this->buatKedutaan('Australia');

        $this->withSession(['auth_email' => 'admin@example.test', 'auth_role' => 'admin'])
            ->get(route('kedutaan-besar.index'))
            ->assertOk()
            ->assertSee('pilih-semua', false)
            ->assertSee('class="form-check-input border-secondary m-0 align-middle pilih-baris" value="'.$australia->getKey().'"', false)
            ->assertSee('data-ekspor-pilih', false);
    }

    public function test_ekspor_riwayat_diplomasi_parsial_menyaring_hasil_filter(): void
    {
        $mitra = $this->buatKedutaan('Australia')->mitra;
        $buat = fn (string $judul, string $status) => Kerjasama::create([
            'id_mitra' => $mitra->id_mitra,
            'kerjasama' => $judul,
            'tanggal_diterima' => '2026-01-10',
            'status_kerjasama' => $status,
            'is_active' => true,
        ]);
        $a = $buat('Kerjasama A', 'Berjalan');
        $buat('Kerjasama B', 'Berjalan');
        $c = $buat('Kerjasama C', 'Selesai');

        $semua = new EksporDiplomasi(ModulDiplomasi::Kerjasama);
        $parsial = new EksporDiplomasi(ModulDiplomasi::Kerjasama, null, null, [$a->getKey(), $c->getKey()]);
        $parsialDanFilter = new EksporDiplomasi(ModulDiplomasi::Kerjasama, 'Berjalan', null, [$a->getKey(), $c->getKey()]);

        $this->assertCount(3, $semua->baris());
        $this->assertCount(2, $parsial->baris());
        $this->assertCount(1, $parsialDanFilter->baris());
        $this->assertSame('Data terpilih', $parsial->keteranganFilter());
    }

    public function test_seluruh_endpoint_ekspor_menerima_pilih(): void
    {
        $sesi = ['auth_email' => 'admin@example.test', 'auth_role' => 'admin'];

        foreach (TipeMitra::cases() as $tipe) {
            foreach (['excel', 'pdf'] as $format) {
                $this->withSession($sesi)->get($tipe->urlEkspor($format).'?pilih=1,2')->assertOk();
            }
        }

        foreach (ModulDiplomasi::cases() as $modul) {
            foreach (['excel', 'pdf'] as $format) {
                $this->withSession($sesi)->get($modul->urlEkspor($format).'?pilih=1,2')->assertOk();
                $this->withSession($sesi)->get($modul->urlEkspor($format).'?pilih=x')->assertStatus(422);
            }
        }
    }

    public function test_seluruh_index_modul_punya_kolom_pilih(): void
    {
        // tahunTersedia() memakai YEAR() milik MySQL; SQLite uji tidak punya.
        DB::connection()->getPdo()->sqliteCreateFunction('YEAR', fn (?string $tanggal) => $tanggal ? (int) substr($tanggal, 0, 4) : null);

        $sesi = ['auth_email' => 'admin@example.test', 'auth_role' => 'admin'];
        $rute = [...array_map(fn (TipeMitra $t) => $t->routeIndex(), TipeMitra::cases()),
            ...array_map(fn (ModulDiplomasi $m) => $m->routeIndex(), ModulDiplomasi::cases())];

        $this->assertCount(14, $rute);

        foreach ($rute as $nama) {
            $this->withSession($sesi)->get(route($nama))
                ->assertOk()
                ->assertSee('pilih-semua', false)
                ->assertSee('data-ekspor-pilih', false);
        }
    }
}
