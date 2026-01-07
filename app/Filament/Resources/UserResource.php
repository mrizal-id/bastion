<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\BadgeableVisualizer; // Opsional
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(User::class, 'email', ignoreRecord: true),

                    TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        ->dehydrated(fn($state) => filled($state))
                        ->required(fn(string $context): bool => $context === 'create'),

                    Select::make('status')
                        ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'suspended' => 'Suspended',
                            'blacklisted' => 'Blacklisted',
                        ])
                        ->default('active')
                        ->required(),

                    Select::make('roles')
                        ->multiple()
                        ->relationship('roles', 'name') // Integrasi Spatie
                        ->preload(),

                    TextInput::make('security_level')
                        ->numeric()
                        ->default(1)
                        ->maxValue(5)
                        ->helperText('Level 5 adalah akses tertinggi.'),
                ])->columns(2),

                Card::make()->schema([
                    Forms\Components\Placeholder::make('fraud_metadata')
                        ->label('Fraud Detection Metadata')
                        ->content(fn($record): string => $record ?
                            "Last IP: {$record->last_ip_address} | Device: {$record->device_fingerprint}" :
                            'No data available'),

                    Forms\Components\Placeholder::make('version')
                        ->label('Optimistic Lock Version')
                        ->content(fn($record): string => $record?->version ?? '1'),
                ])->columns(2)->visible(fn($record) => $record !== null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'inactive',
                        'danger' => 'suspended',
                        'primary' => 'blacklisted',
                    ]),

                // REVISI: Gunakan TagsColumn untuk menampilkan multiple roles di v2
                Tables\Columns\TagsColumn::make('roles.name')
                    ->label('Roles'),

                Tables\Columns\TextColumn::make('security_level')
                    ->label('Sec Level')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Joined'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'blacklisted' => 'Blacklisted',
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
