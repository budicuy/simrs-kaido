<?php

namespace App\Filament\Resources\PendaftaranResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PendaftaranResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PendaftaranResource\Api\Transformers\PendaftaranTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PendaftaranResource::class;


    /**
     * Show Pendaftaran
     *
     * @param Request $request
     * @return PendaftaranTransformer
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

        return new PendaftaranTransformer($query);
    }
}
