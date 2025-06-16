<?php
namespace App\Filament\Resources\PerawatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PerawatResource;
use App\Filament\Resources\PerawatResource\Api\Requests\UpdatePerawatRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PerawatResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Perawat
     *
     * @param UpdatePerawatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePerawatRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}