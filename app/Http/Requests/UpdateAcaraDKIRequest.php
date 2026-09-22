<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAcaraDKIRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelaksana' => ['nullable', 'string', 'max:255'],
            'acara_dki' => ['required', 'string'],
            'rangkuman' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
            'tanggal_diterima' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_diterima'],
            'tanggal_awal_pelaksanaan' => ['nullable', 'date'],
            'tanggal_akhir_pelaksanaan' => ['nullable', 'date', 'after_or_equal:tanggal_awal_pelaksanaan'],
            'triwulan_acara_dki' => ['required', 'in:TW I,TW II,TW III,TW IV'],
            'status_acara_dki' => ['required', 'in:Berjalan,Selesai,Tunda,Batal,Regret'],
            'mitra' => ['required', 'array', 'min:1'],
            'mitra.*.id_mitra' => ['required', 'integer', 'distinct', 'exists:tb_mitra,id_mitra'],
            'mitra.*.status_kehadiran' => ['required', 'in:Diundang,Hadir,Tidak Hadir'],
            'mitra.*.keterangan_kehadiran' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'pelaksana' => 'Pelaksana',
            'acara_dki' => 'Acara DKI',
            'rangkuman' => 'Rangkuman',
            'catatan' => 'Catatan',
            'tanggal_diterima' => 'Tanggal Diterima',
            'tanggal_selesai' => 'Tanggal Selesai',
            'tanggal_awal_pelaksanaan' => 'Tanggal Awal Pelaksanaan',
            'tanggal_akhir_pelaksanaan' => 'Tanggal Akhir Pelaksanaan',
            'status_acara_dki' => 'Status Acara DKI',
            'triwulan_acara_dki' => 'Triwulan',
            'mitra' => 'Mitra',
            'mitra.*.id_mitra' => 'Nama Mitra',
            'mitra.*.status_kehadiran' => 'Status Kehadiran',
            'mitra.*.keterangan_kehadiran' => 'Keterangan Kehadiran',
        ];
    }
}
