<?php
namespace App\Filament\Resources\PendaftaranResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PendaftaranResource;
use Illuminate\Routing\Router;


class PendaftaranApiService extends ApiService
{
    protected static string | null $resource = PendaftaranResource::class;

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
