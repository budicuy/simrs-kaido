<?php

namespace App\Filament\Resources\PendaftaranResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PendaftaranResource;

class DeleteHandler extends Handlers
{
    public static string | null $uri = '/{rm}';
    public static string | null $resource = PendaftaranResource::class;

    public static function getMethod()
    {
        return Handlers::DELETE;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Delete Pendaftaran
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(Request $request)
    {
        $rm = $request->route('rm');

        $model = static::getModel()::find($rm);

        if (!$model) return static::sendNotFoundResponse();

        $model->delete();

        return static::sendSuccessResponse($model, "Successfully Delete Resource");
    }
}
