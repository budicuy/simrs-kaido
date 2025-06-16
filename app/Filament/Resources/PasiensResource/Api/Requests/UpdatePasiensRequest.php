<?php

namespace App\Filament\Resources\PasiensResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasiensRequest extends FormRequest
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
			'nik' => 'required|integer',
			'nama_pasien' => 'required|string',
			'tgl_lahir' => 'required|date',
			'agama' => 'required',
			'kabupaten' => 'required',
			'pekerjaan' => 'required|string',
			'jns_kelamin' => 'required',
			'alamat' => 'required|string',
			'no_hp_pasien' => 'required',
			'email_pasien' => 'required|string',
			'gol_darah' => 'required'
		];
    }
}
