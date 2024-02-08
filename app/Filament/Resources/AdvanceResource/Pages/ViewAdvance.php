<?php

namespace App\Filament\Resources\AdvanceResource\Pages;

use App\Filament\Resources\AdvanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdvance extends ViewRecord
{
    protected static string $resource = AdvanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
