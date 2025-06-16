<?php

namespace App\Filament\Resources\PerawatResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PerawatResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PerawatResource\Api\Transformers\PerawatTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PerawatResource::class;


    /**
     * Show Perawat
     *
     * @param Request $request
     * @return PerawatTransformer
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

        return new PerawatTransformer($query);
    }
}
