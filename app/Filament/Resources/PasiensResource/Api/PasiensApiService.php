<?php
namespace App\Filament\Resources\PasiensResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PasiensResource;
use Illuminate\Routing\Router;


class PasiensApiService extends ApiService
{
    protected static string | null $resource = PasiensResource::class;

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
