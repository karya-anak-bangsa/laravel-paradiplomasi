<?php

namespace Tests\Feature;

use App\Enums\ModulDiplomasi;
use App\Enums\TipeMitra;
use App\Models\AcaraDKI;
use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Models\Mitra;
use App\Support\EksporRiwayatMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EksporRiwayatMitraTest extends TestCase
{
    use RefreshDatabase;

    private const SESI = ['auth_email' => 'admin@example.test', 'auth_role' => 'admin'];

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

    private function buatKerjasama(Mitra $mitra, string $judul, bool $aktif = true): Kerjasama
    {
        return Kerjasama::create([
            'id_mitra' => $mitra->id_mitra,
            'kerjasama' => $judul,
            'tanggal_diterima' => '2026-01-10',
            'status_kerjasama' => 'Berjalan',
            'is_active' => $aktif,
        ]);
    }

    public function test_file_dibagi_per_modul_dan_hanya_berisi_riwayat_aktif_mitra_itu(): void
    {
        $australia = $this->buatKedutaan('Australia')->mitra;
        $belanda = $this->buatKedutaan('Belanda')->mitra;

        $this->buatKerjasama($australia, '<p>Pertukaran &amp; pelajar</p>');
        $this->buatKerjasama($australia, 'Sudah dihapus', aktif: false);
        $this->buatKerjasama($belanda, 'Milik Belanda');

        $acara = AcaraDKI::create([
            'acara_dki' => 'Festival Budaya Betawi',
            'tanggal_diterima' => '2026-03-01',
            'status_acara_dki' => 'Selesai',
            'is_active' => true,
        ]);
        $acara->mitra()->attach($australia->id_mitra, [
            'status_kehadiran' => 'Tidak Hadir',
            'keterangan_kehadiran' => 'Bentrok jadwal',
        ]);

        $ekspor = new EksporRiwayatMitra($australia);
        $bagian = $ekspor->bagian();

        $this->assertSame('Riwayat Diplomasi Kedutaan Besar Australia', $ekspor->judul());
        $this->assertSame(array_map(fn (ModulDiplomasi $m) => $m->value, ModulDiplomasi::cases()), array_map(fn ($b) => $b->namaSheet(), $bagian));
        $this->assertSame(2, $ekspor->jumlahData());

        $kerjasama = $bagian[0]->baris();
        $this->assertCount(1, $kerjasama);
        $this->assertSame('Pertukaran & pelajar', $kerjasama[0]['Kerjasama']);
        $this->assertSame('Masih Berjalan', $kerjasama[0]['Tanggal Selesai']);

        // Acara DKI: status kehadiran di PDF, alasannya hanya di Excel.
        $acaraPdf = end($bagian)->baris()[0];
        $acaraExcel = last($ekspor->bagian(denganAlasan: true))->baris()[0];
        $this->assertSame('Tidak Hadir', $acaraPdf['Kehadiran']);
        $this->assertArrayNotHasKey('Keterangan Kehadiran', $acaraPdf);
        $this->assertSame('Bentrok jadwal', $acaraExcel['Keterangan Kehadiran']);

        // Urutan kolom Acara DKI: kehadiran tepat setelah judul, tanggal & status di ujung.
        $this->assertSame(
            ['No', 'Acara DKI', 'Kehadiran', 'Tanggal Diterima', 'Tanggal Selesai', 'Status'],
            end($bagian)->header(),
        );
        $this->assertSame(
            ['No', 'Acara DKI', 'Kehadiran', 'Keterangan Kehadiran', 'Tanggal Diterima', 'Tanggal Selesai', 'Status'],
            last($ekspor->bagian(denganAlasan: true))->header(),
        );
    }

    public function test_filter_tahun_menyaring_tab_dan_file_ekspor(): void
    {
        $kedutaan = $this->buatKedutaan('Australia');
        $mitra = $kedutaan->mitra;

        $buat = fn (string $judul, string $tanggal) => Kerjasama::create([
            'id_mitra' => $mitra->id_mitra,
            'kerjasama' => $judul,
            'tanggal_diterima' => $tanggal,
            'status_kerjasama' => 'Berjalan',
            'is_active' => true,
        ]);
        $buat('Kerjasama Lama', '2025-03-01');
        $buat('Kerjasama Baru', '2026-02-01');

        $acara = AcaraDKI::create([
            'acara_dki' => 'Festival 2024',
            'tanggal_diterima' => '2024-05-01',
            'status_acara_dki' => 'Selesai',
            'is_active' => true,
        ]);
        $acara->mitra()->attach($mitra->id_mitra, ['status_kehadiran' => 'Hadir']);

        // Pilihan dropdown: tahun dari keenam modul, terbaru dulu.
        $this->assertSame(['2026', '2025', '2024'], $mitra->tahunRiwayatDiplomasi());

        // Halaman profil: tab tersaring, dropdown terpilih, tombol ekspor membawa tahun.
        $this->withSession(self::SESI)->get(route('kedutaan-besar.show', ['kedutaan_besar' => $kedutaan, 'tahun' => '2025']))
            ->assertOk()
            ->assertSee('Kerjasama Lama')
            ->assertDontSee('Kerjasama Baru')
            ->assertDontSee('Festival 2024')
            ->assertSee('<option value="2025" selected', false)
            ->assertSee('Belum ada riwayat acara DKI untuk kedutaan ini pada tahun 2025.')
            ->assertSee(e($mitra->urlEkspor('excel', ['tahun' => '2025'])), false);

        // File ekspor: isi & keterangan mengikuti tahun yang sama.
        $ekspor = new EksporRiwayatMitra(Mitra::find($mitra->id_mitra), '2025');
        $this->assertSame(['Kerjasama Lama'], array_column($ekspor->bagian()[0]->baris(), 'Kerjasama'));
        $this->assertSame([], last($ekspor->bagian())->baris());
        $this->assertSame('Tahun 2025 - 1 data', $ekspor->keterangan());
        $this->assertStringContainsString('_2025_', $ekspor->namaFile('pdf'));

        foreach (['excel', 'pdf'] as $format) {
            $this->withSession(self::SESI)->get($mitra->urlEkspor($format, ['tahun' => '2025']))->assertOk();
        }
    }

    public function test_tahun_tidak_sah_diabaikan_menjadi_semua_tahun(): void
    {
        $kedutaan = $this->buatKedutaan('Australia');
        $this->buatKerjasama($kedutaan->mitra, 'Pertukaran pelajar');

        foreach (['1999', 'abc'] as $tahun) {
            $ekspor = new EksporRiwayatMitra(Mitra::find($kedutaan->id_mitra), $tahun);
            $this->assertNull($ekspor->tahun);
            $this->assertSame('Seluruh riwayat diplomasi - 1 data', $ekspor->keterangan());
        }

        $this->withSession(self::SESI)
            ->get(route('kedutaan-besar.show', $kedutaan).'?tahun[]=2026')
            ->assertOk()
            ->assertSee('Pertukaran pelajar');

        $this->withSession(self::SESI)
            ->get(route('ekspor.riwayat-mitra.excel', ['mitra' => $kedutaan->id_mitra]).'?tahun[]=2026')
            ->assertOk();
    }

    public function test_lebar_kolom_pdf_sama_di_keenam_tabel(): void
    {
        $mitra = $this->buatKedutaan('Australia')->mitra;
        $this->buatKerjasama($mitra, 'Pertukaran pelajar'); // "Masih Berjalan" — kolom Tanggal Selesai terlebar

        $ekspor = new EksporRiwayatMitra($mitra);
        $lebar = array_map(fn ($bagian) => $ekspor->lebarKolom($bagian), $ekspor->bagian());

        foreach (['No', 'Tanggal Diterima', 'Tanggal Selesai', 'Status'] as $label) {
            $this->assertCount(1, array_unique(array_column($lebar, $label)), "Lebar kolom {$label} berbeda antar-tabel.");
        }

        // Judul + Kehadiran di Acara DKI = lebar judul di tabel lain.
        $acara = end($lebar);
        $this->assertEqualsWithDelta($lebar[0]['Kerjasama'], $acara['Acara DKI'] + $acara['Kehadiran'], 0.05);
    }

    public function test_endpoint_excel_dan_pdf_untuk_admin_dan_guest(): void
    {
        $mitra = $this->buatKedutaan('Australia')->mitra;
        $this->buatKerjasama($mitra, 'Pertukaran pelajar');

        foreach (['admin', 'guest'] as $peran) {
            foreach (['excel', 'pdf'] as $format) {
                $this->withSession(['auth_email' => $peran.'@example.test', 'auth_role' => $peran])
                    ->get($mitra->urlEkspor($format))
                    ->assertOk()
                    ->assertDownload();
            }
        }
    }

    public function test_mitra_yang_sudah_dihapus_tidak_bisa_diekspor(): void
    {
        $kedutaan = $this->buatKedutaan('Australia');
        $url = $kedutaan->mitra->urlEkspor('excel');
        $kedutaan->delete();

        $this->withSession(self::SESI)->get($url)->assertNotFound();
    }

    public function test_seluruh_halaman_profil_mitra_punya_tombol_ekspor_riwayat(): void
    {
        foreach (TipeMitra::cases() as $tipe) {
            $atribut = [$tipe->kolomNama() => 'Mitra Uji '.$tipe->slug(), 'is_active' => true];

            if ($tipe->berbasisNegara()) {
                $atribut += [
                    'kode_negara' => 'au',
                    'nama_negara' => 'Australia',
                    Str::replaceLast('_id', '_en', $tipe->kolomNama()) => 'Test '.$tipe->slug(),
                ];
            }

            if ($tipe === TipeMitra::PerwakilanRi) {
                $atribut['tipe_perwakilan_ri'] = 'KBRI';
            }

            /** @var Model $subtype */
            $subtype = $tipe->modelClass()::create($atribut);

            $this->withSession(self::SESI)->get(route($tipe->routeShow(), $subtype))
                ->assertOk()
                ->assertSee($subtype->mitra->urlEkspor('excel'), false)
                ->assertSee($subtype->mitra->urlEkspor('pdf'), false);

            foreach (['excel', 'pdf'] as $format) {
                $this->withSession(self::SESI)->get($subtype->mitra->urlEkspor($format))->assertOk();
            }
        }
    }
}
