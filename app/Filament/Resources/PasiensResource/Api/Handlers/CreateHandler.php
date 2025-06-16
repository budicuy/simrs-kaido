<?php
namespace App\Filament\Resources\PasiensResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PasiensResource;
use App\Filament\Resources\PasiensResource\Api\Requests\CreatePasiensRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PasiensResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Pasiens
     *
     * @param CreatePasiensRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePasiensRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}