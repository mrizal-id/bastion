<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LedgerResource\Pages;
use App\Models\Ledger;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Model;

class LedgerResource extends Resource
{
    protected static ?string $model = Ledger::class;
    protected static ?string $navigationIcon = 'heroicon-o-database';
    protected static ?string $navigationGroup = 'Finance';

    // Menonaktifkan fitur Create
    public static function canCreate(): bool
    {
        return false;
    }

    // Menonaktifkan fitur Edit (dengan parameter Model)
    public static function canEdit(Model $record): bool
    {
        return false; // Menonaktifkan fitur edit
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form kosong karena fitur create dinonaktifkan
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('created_at')->dateTime()->label('Timestamp'),
            TextColumn::make('account.user.name')->label('User'),

            BadgeColumn::make('type')
                ->colors([
                    'danger' => 'debit',  // Uang keluar
                    'success' => 'credit', // Uang masuk
                ]),

            TextColumn::make('amount')
                ->money('idr', true)
                ->weight('bold'),

            TextColumn::make('balance_after')
                ->label('Balance After')
                ->money('idr', true),

            TextColumn::make('reference_type')->label('Source'),
            TextColumn::make('idempotency_key')->label('ID Key')->limit(8),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLedgers::route('/'),
            // Tidak ada halaman 'create' dan 'edit' karena fitur tersebut dinonaktifkan
        ];
    }
}
