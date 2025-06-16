<?php
namespace App\Filament\Resources\PoliResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PoliResource;
use App\Filament\Resources\PoliResource\Api\Requests\CreatePoliRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PoliResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Poli
     *
     * @param CreatePoliRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePoliRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}