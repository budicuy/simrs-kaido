<?php

namespace App\Filament\Resources\PendaftaranResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePendaftaranRequest extends FormRequest
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
			'rm' => 'required|integer',
			'id_poli' => 'required|integer',
			'tgl_kunjungan' => 'required|date',
			'no_antrian' => 'required|integer',
			'status' => 'required'
		];
    }
}
