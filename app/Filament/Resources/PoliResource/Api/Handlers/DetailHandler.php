<?php

namespace App\Filament\Resources\PoliResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PoliResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PoliResource\Api\Transformers\PoliTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PoliResource::class;


    /**
     * Show Poli
     *
     * @param Request $request
     * @return PoliTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new PoliTransformer($query);
    }
}
