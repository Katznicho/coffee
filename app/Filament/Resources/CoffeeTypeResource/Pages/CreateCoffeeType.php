<?php

namespace App\Filament\Resources\CoffeeTypeResource\Pages;

use App\Filament\Resources\CoffeeTypeResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCoffeeType extends CreateRecord
{
    protected static string $resource = CoffeeTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Coffee type created successfully')
            ->body('The coffee type has been registered successfully');
    }
}
