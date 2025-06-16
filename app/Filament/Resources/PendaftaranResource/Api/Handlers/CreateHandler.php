<?php
namespace App\Filament\Resources\PendaftaranResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PendaftaranResource;
use App\Filament\Resources\PendaftaranResource\Api\Requests\CreatePendaftaranRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PendaftaranResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Pendaftaran
     *
     * @param CreatePendaftaranRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePendaftaranRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}