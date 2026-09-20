<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNonPerwakilanNegaraAsingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_non_perwakilan_negara_asing' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_non_perwakilan_negara_asing' => 'Nama Non Perwakilan Negara Asing',
            'keterangan' => 'Keterangan',
        ];
    }
}
