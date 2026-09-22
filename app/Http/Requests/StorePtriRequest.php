<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePtriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_ptri' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_ptri' => 'Nama PTRI',
            'keterangan' => 'Keterangan',
        ];
    }
}
