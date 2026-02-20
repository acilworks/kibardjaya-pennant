<?php

namespace App\Filament\Resources\ShippingProvinceResource\Pages;

use App\Filament\Resources\ShippingProvinceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShippingProvinces extends ListRecords
{
    protected static string $resource = ShippingProvinceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
