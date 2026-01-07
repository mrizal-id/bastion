<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Business Entity';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('owner_id')
                        ->relationship('owner', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Brand Owner'),

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->lazy() // Update slug saat user selesai mengetik
                        ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->unique(Brand::class, 'slug', ignoreRecord: true)
                        ->disabled() // Slug otomatis, biar user tidak asal ubah
                        ->dehydrated(), // Tetap dikirim ke database saat save

                    TextInput::make('daily_limit')
                        ->numeric()
                        ->prefix('IDR')
                        ->helperText('Batas transaksi harian untuk deteksi fraud.')
                        ->default(0),

                    Toggle::make('is_verified')
                        ->label('Verified Brand')
                        ->onIcon('heroicon-s-badge-check')
                        ->offIcon('heroicon-s-x-circle')
                        ->default(false),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('owner.name')
                    ->label('Owner')
                    ->searchable(),

                TextColumn::make('name')
                    ->weight('bold')
                    ->searchable(),

                IconColumn::make('is_verified')
                    ->boolean()
                    ->label('Verified'),

                TextColumn::make('daily_limit')
                    ->money('idr', shouldConvert: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_verified'),
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
