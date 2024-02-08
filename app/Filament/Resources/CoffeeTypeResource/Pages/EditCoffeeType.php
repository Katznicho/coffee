<?php

namespace App\Filament\Resources\CoffeeTypeResource\Pages;

use App\Filament\Resources\CoffeeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoffeeType extends EditRecord
{
    protected static string $resource = CoffeeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
