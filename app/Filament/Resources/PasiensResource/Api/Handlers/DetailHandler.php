<?php

namespace App\Filament\Resources\PasiensResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PasiensResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PasiensResource\Api\Transformers\PasiensTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PasiensResource::class;


    /**
     * Show Pasiens
     *
     * @param Request $request
     * @return PasiensTransformer
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

        return new PasiensTransformer($query);
    }
}
