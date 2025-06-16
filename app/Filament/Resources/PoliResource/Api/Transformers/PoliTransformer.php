<?php
namespace App\Filament\Resources\PoliResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Poli;

/**
 * @property Poli $resource
 */
class PoliTransformer extends JsonResource
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
