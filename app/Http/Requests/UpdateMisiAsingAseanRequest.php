<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMisiAsingAseanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_negara' => ['required', 'string', 'max:2'],
            'nama_negara' => ['required', 'string'],
            'nama_misi_asing_asean_id' => ['required', 'string'],
            'nama_misi_asing_asean_en' => ['required', 'string'],
            'format_undangan' => ['nullable', 'string'],
            'nama_diplomat' => ['nullable', 'string'],
            'telepon_kantor' => ['nullable', 'string'],
            'email_kantor' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string'],
            'kelurahan' => ['nullable', 'string'],
            'kecamatan' => ['nullable', 'string'],
            'kota' => ['nullable', 'string'],
            'kode_pos' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_negara' => 'Kode Negara',
            'nama_negara' => 'Nama Negara',
            'nama_misi_asing_asean_id' => 'Nama Misi (ID)',
            'nama_misi_asing_asean_en' => 'Nama Misi (EN)',
            'format_undangan' => 'Format Undangan',
            'nama_diplomat' => 'Nama Diplomat',
            'telepon_kantor' => 'Telepon Kantor',
            'email_kantor' => 'Email Kantor',
            'alamat' => 'Alamat',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kota' => 'Kota',
            'kode_pos' => 'Kode Pos',
        ];
    }
}
