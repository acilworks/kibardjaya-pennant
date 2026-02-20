<?php

namespace App\Filament\Resources\ShippingProvinceResource\Pages;

use App\Filament\Resources\ShippingProvinceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShippingProvince extends EditRecord
{
    protected static string $resource = ShippingProvinceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
