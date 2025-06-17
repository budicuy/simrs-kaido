<?php

namespace App\Filament\Resources\PendaftaranResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PendaftaranResource;
use App\Filament\Resources\PendaftaranResource\Api\Requests\UpdatePendaftaranRequest;

class UpdateHandler extends Handlers
{
    public static string | null $uri = '/{rm}';
    public static string | null $resource = PendaftaranResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }


    /**
     * Update Pendaftaran
     *
     * @param UpdatePendaftaranRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePendaftaranRequest $request)
    {
        try {
            $rm = $request->route('rm');

            $model = static::getModel()::where('rm', $rm)->first();

            if (!$model) return static::sendNotFoundResponse();
            
            // Log request data for debugging
            \Log::info('Pendaftaran Update Request Data:', $request->all());

            $model->fill($request->validated());

            $model->save();

            return static::sendSuccessResponse($model, "Successfully Update Resource");
        } catch (\Exception $e) {
            \Log::error('Error updating pendaftaran:', [
                'message' => $e->getMessage(),
                'request_data' => $request->all(),
                'rm' => $request->route('rm')
            ]);
            
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengupdate pendaftaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
