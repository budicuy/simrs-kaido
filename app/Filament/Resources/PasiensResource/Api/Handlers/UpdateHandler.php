<?php
namespace App\Filament\Resources\PasiensResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PasiensResource;
use App\Filament\Resources\PasiensResource\Api\Requests\UpdatePasiensRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PasiensResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Pasiens
     *
     * @param UpdatePasiensRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePasiensRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}