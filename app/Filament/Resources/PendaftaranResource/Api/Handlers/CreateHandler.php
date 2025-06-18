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
        try {
            $model = new (static::getModel());
            
            // Log request data for debugging
            \Log::info('Pendaftaran Create Request Data:', $request->all());
            
            $model->fill($request->validated());

            $model->save();

            return static::sendSuccessResponse($model, "Successfully Create Resource");
        } catch (\Exception $e) {
            \Log::error('Error creating pendaftaran:', [
                'message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'message' => 'Terjadi kesalahan saat membuat pendaftaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}