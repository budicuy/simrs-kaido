<?php

namespace App\Filament\Resources\PoliResource\Pages;

use App\Filament\Resources\PoliResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePoli extends CreateRecord
{
    protected static string $resource = PoliResource::class;
    protected static bool $canCreateAnother = false;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
