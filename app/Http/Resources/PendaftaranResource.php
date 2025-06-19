<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['pendaftaran']->id,
            'rm' => $this['pendaftaran']->rm,
            'nama_pasien' => $this['pasien']->nama_pasien,
            'nik' => $this['pasien']->nik,
            'poli' => $this['poli']->nama_poli,
            'tgl_kunjungan' => $this['pendaftaran']->tgl_kunjungan,
            'no_antrian' => $this['pendaftaran']->no_antrian,
            'status' => $this['pendaftaran']->status,
        ];
    }
}
