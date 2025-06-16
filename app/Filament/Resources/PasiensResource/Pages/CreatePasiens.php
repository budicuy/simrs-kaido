<?php

namespace App\Filament\Resources\PasiensResource\Pages;

use App\Filament\Resources\PasiensResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePasiens extends CreateRecord
{
    protected static string $resource = PasiensResource::class;
    protected static bool $canCreateAnother = false;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
