<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MultiSelect;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true),

                // Multiselect untuk memilih Permission yang tergabung dalam Role ini
                MultiSelect::make('permissions')
                    ->relationship('permissions', 'name')
                    ->preload()
            ])
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('UUID')->limit(8),
            TextColumn::make('name')->searchable(),
            TextColumn::make('permissions_count')
                ->counts('permissions')
                ->label('Total Permissions'),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
