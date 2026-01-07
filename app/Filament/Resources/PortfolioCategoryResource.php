<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioCategoryResource\Pages;
use App\Models\PortfolioCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class PortfolioCategoryResource extends Resource
{
    protected static ?string $model = PortfolioCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag'; // Icon tag lebih cocok untuk kategori

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(100)
                        ->lazy() // Menggunakan lazy agar slug tidak berubah setiap ketukan tombol (lebih ringan)
                        ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(100)
                        ->unique(PortfolioCategory::class, 'slug', ignoreRecord: true)
                        ->helperText('Slug akan terisi otomatis dari nama, pastikan formatnya URL-friendly.'),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->fontFamily('mono')
                    ->color('secondary'),

                // Menampilkan jumlah portfolio dalam kategori ini
                Tables\Columns\TextColumn::make('portfolios_count')
                    ->label('Total Portfolios')
                    ->counts('portfolios') // Menghitung otomatis relasi 'portfolios' di model
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Jika ingin melihat daftar portfolio di dalam detail kategori
            // RelationManagers\PortfoliosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolioCategories::route('/'),
            'create' => Pages\CreatePortfolioCategory::route('/create'),
            'edit' => Pages\EditPortfolioCategory::route('/{record}/edit'),
        ];
    }
}
