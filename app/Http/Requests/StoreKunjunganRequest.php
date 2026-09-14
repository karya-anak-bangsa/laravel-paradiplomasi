<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKunjunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kedutaan_besar'  => ['required', 'integer', 'exists:tb_kedutaan_besar,id_kedutaan_besar'],
            'perihal'            => ['required', 'string'],
            'rangkuman'          => ['required', 'string'],
            'catatan'            => ['required', 'string'],
            'tanggal_diterima'   => ['required', 'date'],
            'tanggal_selesai'    => ['nullable', 'date', 'after_or_equal:tanggal_diterima'],
            'triwulan_kunjungan' => ['required', 'in:TW I,TW II,TW III,TW IV'],
            'status_kunjungan'   => ['required', 'in:Berjalan,Selesai,Tunda,Batal,Regret'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kedutaan_besar'  => 'Nama Negara',
            'perihal'            => 'Perihal',
            'rangkuman'          => 'Rangkuman',
            'catatan'            => 'Catatan',
            'tanggal_diterima'   => 'Tanggal Diterima',
            'tanggal_selesai'    => 'Tanggal Selesai',
            'triwulan_kunjungan' => 'Triwulan',
            'status_kunjungan'   => 'Status Kunjungan',
        ];
    }
}
