<?php
namespace App\Filament\Resources\PasiensResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pasiens;

/**
 * @property Pasiens $resource
 */
class PasiensTransformer extends JsonResource
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
