<?php
namespace App\Filament\Resources\PerawatResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PerawatResource;
use Illuminate\Routing\Router;


class PerawatApiService extends ApiService
{
    protected static string | null $resource = PerawatResource::class;

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
