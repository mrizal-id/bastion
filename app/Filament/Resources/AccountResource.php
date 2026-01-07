<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers\LedgersRelationManager;
use App\Models\Account;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Finance';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(3)->schema([
                Card::make()->schema([
                    TextInput::make('balance')
                        ->numeric()
                        ->prefix('IDR')
                        ->disabled()
                        ->label('Saldo Saat Ini'),
                    TextInput::make('currency')
                        ->disabled(),
                ])->columnSpan(2),

                Card::make()->schema([
                    Placeholder::make('created_at')
                        ->label('Akun Dibuat')
                        ->content(fn($record): string => $record->created_at ? $record->created_at->diffForHumans() : '-'),
                    TextInput::make('version')
                        ->label('Security Version')
                        ->disabled()
                        ->helperText('Optimistic locking version'),
                ])->columnSpan(1),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pemilik Akun')
                    ->searchable()
                    ->description(fn(Account $record): string => $record->user->email),

                TextColumn::make('balance')
                    ->label('Total Saldo')
                    ->money('idr', true)
                    ->color('success')
                    ->weight('bold')
                    ->sortable(),

                BadgeColumn::make('currency')
                    ->colors(['primary']),

                TextColumn::make('updated_at')
                    ->label('Aktifitas Terakhir')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter berdasarkan mata uang jika nanti Bastion support Multi-currency
                SelectFilter::make('currency')
                    ->options([
                        'IDR' => 'Rupiah (IDR)',
                        'USD' => 'Dollar (USD)',
                    ]),
            ])
            ->defaultSort('balance', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            LedgersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
