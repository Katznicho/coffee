<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoffeeTypeResource\Pages;
use App\Filament\Resources\CoffeeTypeResource\RelationManagers;
use App\Models\CoffeeType;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoffeeTypeResource extends Resource
{
    protected static ?string $model = CoffeeType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Coffee Type';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Create a new coffee type')
                    ->description('Add a new coffee type to the system.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image')
                            ->directory("coffee-types")
                            ->image(),
                        // Forms\Components\TextInput::make('description'),
                        MarkdownEditor::make('description')
                            ->label("Description"),

                    ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label("Name"),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label("Description"),
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
            'index' => Pages\ListCoffeeTypes::route('/'),
            'create' => Pages\CreateCoffeeType::route('/create'),
            'view' => Pages\ViewCoffeeType::route('/{record}'),
            'edit' => Pages\EditCoffeeType::route('/{record}/edit'),
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
