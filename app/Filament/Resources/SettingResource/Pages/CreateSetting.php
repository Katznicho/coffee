<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Setting created successfully')
            ->body('The setting has been registered successfully');
    }
}
