<?php

namespace App\Filament\Resources\BalancingResource\Pages;

use App\Filament\Resources\BalancingResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateBalancing extends CreateRecord
{
    protected static string $resource = BalancingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Balance created successfully')
            ->body('The balance has been registered successfully');
    }
}
