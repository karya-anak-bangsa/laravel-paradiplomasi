<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcaraDKIRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'acara_dki' => ['required', 'string'],
            'rangkuman' => ['required', 'string'],
            'catatan' => ['required', 'string'],
            'tanggal_diterima' => ['required', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_diterima'],
            'tanggal_awal_pelaksanaan' => ['nullable', 'date'],
            'tanggal_akhir_pelaksanaan' => ['nullable', 'date', 'after_or_equal:tanggal_awal_pelaksanaan'],
            'triwulan_acara_dki' => ['required', 'in:TW I,TW II,TW III,TW IV'],
            'status_acara_dki' => ['required', 'in:Berjalan,Selesai,Tunda,Batal,Regret'],
        ];
    }

    public function attributes(): array
    {
        return [
            'acara_dki' => 'Acara DKI',
            'rangkuman' => 'Rangkuman',
            'catatan' => 'Catatan',
            'tanggal_diterima' => 'Tanggal Diterima',
            'tanggal_selesai' => 'Tanggal Selesai',
            'tanggal_awal_pelaksanaan' => 'Tanggal Awal Pelaksanaan',
            'tanggal_akhir_pelaksanaan' => 'Tanggal Akhir Pelaksanaan',
            'triwulan_acara_dki' => 'Triwulan',
            'status_acara_dki' => 'Status Acara DKI',
        ];
    }
}
