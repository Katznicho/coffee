<?php

namespace App\Filament\Resources\CoffeeTypeResource\Pages;

use App\Filament\Resources\CoffeeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCoffeeType extends ViewRecord
{
    protected static string $resource = CoffeeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
