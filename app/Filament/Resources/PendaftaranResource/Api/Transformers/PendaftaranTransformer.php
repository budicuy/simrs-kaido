<?php
namespace App\Filament\Resources\PendaftaranResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pendaftaran;

/**
 * @property Pendaftaran $resource
 */
class PendaftaranTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
