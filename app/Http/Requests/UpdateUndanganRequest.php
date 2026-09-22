<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUndanganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_mitra' => ['required', 'integer', 'exists:tb_mitra,id_mitra'],
            'acara' => ['required', 'string'],
            'rangkuman' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
            'tanggal_diterima' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_diterima'],
            'triwulan_undangan' => ['required', 'in:TW I,TW II,TW III,TW IV'],
            'status_undangan' => ['required', 'in:Berjalan,Selesai,Tunda,Batal,Regret'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_mitra' => 'Nama Negara',
            'acara' => 'Acara',
            'rangkuman' => 'Rangkuman',
            'catatan' => 'Catatan',
            'tanggal_diterima' => 'Tanggal Diterima',
            'tanggal_selesai' => 'Tanggal Selesai',
            'status_undangan' => 'Status Undangan',
            'triwulan_undangan' => 'Triwulan',
        ];
    }
}
