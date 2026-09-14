<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKedutaanBesarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_negara'            => ['required', 'string', 'max:2'],
            'nama_negara'            => ['required', 'string'],
            'nama_kedutaan_besar_id' => ['required', 'string'],
            'nama_kedutaan_besar_en' => ['required', 'string'],
            'format_undangan'        => ['nullable', 'string'],
            'nama_diplomat'          => ['nullable', 'string'],
            'jabatan_diplomat'       => ['nullable', 'string'],
            'email_kantor'           => ['nullable', 'string'],
            'telepon_kantor'         => ['nullable', 'string'],
            'alamat'                 => ['nullable', 'string'],
            'kelurahan'              => ['nullable', 'string'],
            'kecamatan'              => ['nullable', 'string'],
            'kota'                   => ['nullable', 'string'],
            'kode_pos'               => ['nullable', 'string'],
            'website'                => ['nullable', 'string'],
            'latitude'               => ['nullable', 'numeric'],
            'longitude'              => ['nullable', 'numeric'],
            'is_active'              => ['required', 'in:0,1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_negara'            => 'Kode Negara',
            'nama_negara'            => 'Nama Negara',
            'nama_kedutaan_besar_id' => 'Nama Kedutaan (ID)',
            'nama_kedutaan_besar_en' => 'Nama Kedutaan (EN)',
            'format_undangan'        => 'Format Undangan',
            'nama_diplomat'          => 'Nama Diplomat',
            'jabatan_diplomat'       => 'Jabatan Diplomat',
            'email_kantor'           => 'Email Kantor',
            'telepon_kantor'         => 'Telepon Kantor',
            'alamat'                 => 'Alamat',
            'kelurahan'              => 'Kelurahan',
            'kecamatan'              => 'Kecamatan',
            'kota'                   => 'Kota',
            'kode_pos'               => 'Kode Pos',
            'website'                => 'Website',
            'latitude'               => 'Latitude',
            'longitude'              => 'Longitude',
            'is_active'              => 'Status Data',
        ];
    }
}
