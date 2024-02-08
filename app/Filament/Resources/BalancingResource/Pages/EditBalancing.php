<?php

namespace App\Filament\Resources\BalancingResource\Pages;

use App\Filament\Resources\BalancingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBalancing extends EditRecord
{
    protected static string $resource = BalancingResource::class;

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
