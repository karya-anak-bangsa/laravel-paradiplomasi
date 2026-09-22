<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePemprovDkiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pemprov_dki' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_pemprov_dki' => 'Nama Perangkat Daerah',
            'keterangan' => 'Keterangan',
        ];
    }
}
