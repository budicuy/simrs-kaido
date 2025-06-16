<?php

namespace App\Filament\Resources\PoliResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePoliRequest extends FormRequest
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
			'nama_poli' => 'required|string',
			'id_dokter' => 'required|integer',
			'id_perawat' => 'required|integer'
		];
    }
}
