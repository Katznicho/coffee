<?php

namespace App\Filament\Resources\BalancingResource\Pages;

use App\Filament\Resources\BalancingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBalancing extends ViewRecord
{
    protected static string $resource = BalancingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
