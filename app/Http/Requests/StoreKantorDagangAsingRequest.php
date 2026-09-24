<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKantorDagangAsingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kantor_dagang_asing' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_kantor_dagang_asing' => 'Nama Kantor Dagang Asing',
            'keterangan' => 'Keterangan',
        ];
    }
}
