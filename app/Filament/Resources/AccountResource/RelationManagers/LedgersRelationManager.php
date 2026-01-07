<?php

namespace App\Filament\Resources\AccountResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class LedgersRelationManager extends RelationManager
{
    protected static string $relationship = 'ledgers';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
                BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'success' => 'credit',
                        'danger' => 'debit',
                    ])
                    ->enum([
                        'credit' => 'Masuk (+)',
                        'debit' => 'Keluar (-)',
                    ]),
                TextColumn::make('amount')
                    ->label('Nominal')
                    ->money('idr', true),
                TextColumn::make('balance_after')
                    ->label('Saldo Akhir')
                    ->money('idr', true),
                TextColumn::make('reference_type')
                    ->label('Keterangan')
                    ->formatStateUsing(fn($state) => str_replace('_', ' ', $state)),
            ])
            ->defaultSort('created_at', 'desc'); // Urutkan dari yang terbaru
    }
}
