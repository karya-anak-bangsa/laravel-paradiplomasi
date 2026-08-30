<?php

namespace Database\Seeders;

use App\Models\KedutaanBesar;
use Illuminate\Database\Seeder;

class KedutaanBesarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_negara'               => 'jp',
                'nama_negara'               => 'Jepang',
                'nama_kedutaan_besar_id'    => 'Kedutaan Besar Jepang',
                'nama_kedutaan_besar_en'    => 'Embassy of Japan',
                'format_undangan'           => 'Surat undangan resmi ditujukan kepada Duta Besar Jepang untuk Republik Indonesia.',
                'nama_diplomat'             => 'Kanasugi Kenji',
                'jabatan_diplomat'          => 'Duta Besar',
                'email_kantor'              => 'info@id.mofa.go.jp, protokol@id.mofa.go.jp',
                'telepon_kantor'            => '021-3192-4308, 021-3192-4309',
                'alamat'                    => 'Jl. M.H. Thamrin No.24',
                'kelurahan'                 => 'Gondangdia',
                'kecamatan'                 => 'Menteng',
                'kota'                      => 'Jakarta Pusat',
                'kode_pos'                  => '10350',
                'website'                   => 'https://www.id.emb-japan.go.jp',
                'latitude'                  => -6.1934940,
                'longitude'                 => 106.8225700,
                'is_active'                 => true,
            ],
            [
                'kode_negara'               => 'us',
                'nama_negara'               => 'Amerika Serikat',
                'nama_kedutaan_besar_id'    => 'Kedutaan Besar Amerika Serikat',
                'nama_kedutaan_besar_en'    => 'Embassy of the United States of America',
                'format_undangan'           => 'Surat undangan resmi ditujukan kepada Duta Besar Amerika Serikat untuk Republik Indonesia.',
                'nama_diplomat'             => 'Kamala Shirin Lakhdhir',
                'jabatan_diplomat'          => 'Duta Besar',
                'email_kantor'              => 'jakartaacs@state.gov',
                'telepon_kantor'            => '021-5083-1000',
                'alamat'                    => 'Jl. Medan Merdeka Selatan No.3-5',
                'kelurahan'                 => 'Gambir',
                'kecamatan'                 => 'Gambir',
                'kota'                      => 'Jakarta Pusat',
                'kode_pos'                  => '10110',
                'website'                   => 'https://id.usembassy.gov',
                'latitude'                  => -6.1755000,
                'longitude'                 => 106.8230000,
                'is_active'                 => true,
            ],
            [
                'kode_negara'               => 'au',
                'nama_negara'               => 'Australia',
                'nama_kedutaan_besar_id'    => 'Kedutaan Besar Australia',
                'nama_kedutaan_besar_en'    => 'Embassy of Australia',
                'format_undangan'           => 'Surat undangan resmi ditujukan kepada Duta Besar Australia untuk Republik Indonesia.',
                'nama_diplomat'             => 'Rod Brazier',
                'jabatan_diplomat'          => 'Duta Besar',
                'email_kantor'              => 'jakarta.embassy@dfat.gov.au',
                'telepon_kantor'            => '021-2550-5555',
                'alamat'                    => 'Jl. H.R. Rasuna Said Kav. C15-16',
                'kelurahan'                 => 'Karet Kuningan',
                'kecamatan'                 => 'Setiabudi',
                'kota'                      => 'Jakarta Selatan',
                'kode_pos'                  => '12940',
                'website'                   => 'https://indonesia.embassy.gov.au',
                'latitude'                  => -6.2245000,
                'longitude'                 => 106.8305000,
                'is_active'                 => true,
            ],
            [
                'kode_negara'               => 'fr',
                'nama_negara'               => 'Prancis',
                'nama_kedutaan_besar_id'    => 'Kedutaan Besar Prancis',
                'nama_kedutaan_besar_en'    => 'Embassy of France',
                'format_undangan'           => 'Surat undangan resmi ditujukan kepada Duta Besar Prancis untuk Republik Indonesia.',
                'nama_diplomat'             => 'Fabien Penone',
                'jabatan_diplomat'          => 'Duta Besar',
                'email_kantor'              => 'ambassade.jakarta@diplomatie.gouv.fr',
                'telepon_kantor'            => '021-2355-7600',
                'alamat'                    => 'Jl. M.H. Thamrin No.20',
                'kelurahan'                 => 'Gondangdia',
                'kecamatan'                 => 'Menteng',
                'kota'                      => 'Jakarta Pusat',
                'kode_pos'                  => '10350',
                'website'                   => 'https://id.ambafrance.org',
                'latitude'                  => -6.1940000,
                'longitude'                 => 106.8228000,
                'is_active'                 => true,
            ],
            [
                'kode_negara'               => 'cn',
                'nama_negara'               => 'Tiongkok',
                'nama_kedutaan_besar_id'    => 'Kedutaan Besar Republik Rakyat Tiongkok',
                'nama_kedutaan_besar_en'    => 'Embassy of the People\'s Republic of China',
                'format_undangan'           => 'Surat undangan resmi ditujukan kepada Duta Besar Tiongkok untuk Republik Indonesia.',
                'nama_diplomat'             => 'Wang Lutong',
                'jabatan_diplomat'          => 'Duta Besar',
                'email_kantor'              => 'chinaemb_id@mfa.gov.cn',
                'telepon_kantor'            => '021-5761-035',
                'alamat'                    => 'Jl. Mega Kuningan No.2',
                'kelurahan'                 => 'Kuningan Timur',
                'kecamatan'                 => 'Setiabudi',
                'kota'                      => 'Jakarta Selatan',
                'kode_pos'                  => '12950',
                'website'                   => 'http://id.china-embassy.gov.cn',
                'latitude'                  => -6.2320000,
                'longitude'                 => 106.8290000,
                'is_active'                 => true,
            ],
        ];

        foreach ($data as $row) {
            KedutaanBesar::create($row);
        }
    }
}
