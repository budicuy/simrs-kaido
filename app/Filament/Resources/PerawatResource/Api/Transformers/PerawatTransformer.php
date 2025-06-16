<?php
namespace App\Filament\Resources\PerawatResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Perawat;

/**
 * @property Perawat $resource
 */
class PerawatTransformer extends JsonResource
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
