<?php

namespace App\Filament\Resources\BalancingResource\Pages;

use App\Filament\Resources\BalancingResource;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListBalancings extends ListRecords
{
    protected static string $resource = BalancingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
