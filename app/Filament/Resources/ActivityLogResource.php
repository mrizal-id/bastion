<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Filament\Resources\ActivityLogResource\RelationManagers;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Spatie\Activitylog\Models\Activity;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationIcon = 'heroicon-o-finger-print';
    protected static ?string $navigationGroup = 'System Monitor';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;  // Traditional return statement
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->dateTime()->label('Waktu')->sortable(),
                TextColumn::make('causer.name')->label('Admin/User'), // Siapa pelakunya
                TextColumn::make('log_name')->label('Kategori'),
                TextColumn::make('description')->label('Aksi'), // misal: "updated"
                TextColumn::make('subject_type')->label('Modul'), // misal: "App\Models\Project"

                // Menampilkan IP address dari metadata (jika disimpan)
                TextColumn::make('properties.ip')->label('IP Address')->default('-'),
            ])
            ->defaultSort('created_at', 'desc');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
            'create' => Pages\CreateActivityLog::route('/create'),
            'edit' => Pages\EditActivityLog::route('/{record}/edit'),
        ];
    }
}
