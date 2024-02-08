<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
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
use Filament\Forms\Components\MarkdownEditor;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    protected static ?string $navigationGroup = 'Customers';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'address', 'phone_number', 'nin'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Create a new customer')
                    ->description('Add a new customer to the system.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->maxLength(255),
                        PhoneInput::make('phone_number')
                            ->label('Phone Number')
                            ->required()
                            ->unique()
                            ->defaultCountry('UG'),
                        Forms\Components\FileUpload::make('photo')
                            ->directory("customer")
                            ->image(),
                        Forms\Components\TextInput::make('nin')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('balance')
                            ->required()
                            ->maxLength(255)
                            ->default(0),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label("Name"),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label("Address"),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label('Phone Number'),
                Tables\Columns\TextColumn::make('nin')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label("NIN"),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('balance')
                    ->searchable(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
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
