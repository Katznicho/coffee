<?php

namespace App\Filament\Resources\AdvanceResource\Pages;

use App\Filament\Resources\AdvanceResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAdvance extends CreateRecord
{
    protected static string $resource = AdvanceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Advance created successfully')
            ->body('The advance has been created successfully');
    }
}
