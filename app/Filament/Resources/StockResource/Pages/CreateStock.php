<?php

namespace App\Filament\Resources\StockResource\Pages;

use App\Filament\Resources\StockResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateStock extends CreateRecord
{
    protected static string $resource = StockResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Stocl created successfully')
            ->body('The stock has been registered successfully');
    }
}
