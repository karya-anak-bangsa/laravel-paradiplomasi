<?php

namespace App\Http\Requests;

use App\Models\PerwakilanRi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePerwakilanRiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_perwakilan_ri' => ['required', 'string'],
            'tipe_perwakilan_ri' => ['required', Rule::in(array_keys(PerwakilanRi::TIPE_OPTIONS))],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_perwakilan_ri' => 'Nama Perwakilan RI',
            'tipe_perwakilan_ri' => 'Tipe Perwakilan RI',
            'keterangan' => 'Keterangan',
        ];
    }
}
