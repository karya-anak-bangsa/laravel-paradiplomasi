<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePusatKebudayaanAsingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pusat_kebudayaan_asing' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_pusat_kebudayaan_asing' => 'Nama Pusat Kebudayaan Asing',
            'keterangan' => 'Keterangan',
        ];
    }
}
