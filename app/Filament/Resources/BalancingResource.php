<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalancingResource\Pages;
use App\Filament\Resources\BalancingResource\RelationManagers;
use App\Models\Balancing;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BalancingResource extends Resource
{
    protected static ?string $model = Balancing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Balancing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('coffee_type_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('mc')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('initial_kgs')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('cuttings')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('final_kgs')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('milling')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bag')
                    ->maxLength(255),
                Forms\Components\TextInput::make('box')
                    ->numeric(),
                Forms\Components\TextInput::make('labour')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sun_dry')
                    ->maxLength(255),
                Forms\Components\TextInput::make('transport')
                    ->maxLength(255),
                Forms\Components\TextInput::make('advance')
                    ->maxLength(255),
                Forms\Components\TextInput::make('balance')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coffee_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('initial_kgs')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cuttings')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('final_kgs')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('milling')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('box')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('labour')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sun_dry')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transport')
                    ->searchable(),
                Tables\Columns\TextColumn::make('advance')
                    ->searchable(),
                Tables\Columns\TextColumn::make('balance')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                                ->removeField('from');
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                                ->removeField('until');
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBalancings::route('/'),
            'create' => Pages\CreateBalancing::route('/create'),
            'view' => Pages\ViewBalancing::route('/{record}'),
            'edit' => Pages\EditBalancing::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
