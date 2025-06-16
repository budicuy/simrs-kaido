<?php
namespace App\Filament\Resources\PoliResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PoliResource;
use Illuminate\Routing\Router;


class PoliApiService extends ApiService
{
    protected static string | null $resource = PoliResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
