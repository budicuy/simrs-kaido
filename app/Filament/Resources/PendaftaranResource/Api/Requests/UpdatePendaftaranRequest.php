<?php

namespace App\Filament\Resources\PendaftaranResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePendaftaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rm' => 'required|integer|exists:pasiens,rm',
            'id_poli' => 'required|integer|exists:polis,id',
            'tgl_kunjungan' => 'required|date',
            'no_antrian' => 'required|integer|min:1',
            'status' => 'required|string|in:Menunggu,Dipanggil,Diperiksa,Selesai'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'rm.required' => 'Field rm (nomor rekam medis) wajib diisi.',
            'rm.integer' => 'Field rm harus berupa angka.',
            'rm.exists' => 'Nomor rekam medis tidak ditemukan dalam database pasien.',
            'id_poli.required' => 'Field id_poli wajib diisi.',
            'id_poli.integer' => 'Field id_poli harus berupa angka.',
            'id_poli.exists' => 'ID Poliklinik tidak ditemukan dalam database.',
            'tgl_kunjungan.required' => 'Field tgl_kunjungan wajib diisi.',
            'tgl_kunjungan.date' => 'Field tgl_kunjungan harus berupa tanggal yang valid.',
            'no_antrian.required' => 'Field no_antrian wajib diisi.',
            'no_antrian.integer' => 'Field no_antrian harus berupa angka.',
            'no_antrian.min' => 'Field no_antrian minimal bernilai 1.',
            'status.required' => 'Field status wajib diisi.',
            'status.string' => 'Field status harus berupa string.',
            'status.in' => 'Field status harus berupa salah satu dari: Menunggu, Dipanggil, Diperiksa, Selesai.',
        ];
    }
}
