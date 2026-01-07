<?php

namespace App\Filament\Resources\PortfolioResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use AllowDynamicProperties;

#[AllowDynamicProperties]
class AssetsRelationManager extends RelationManager
{
    protected static string $relationship = 'assets';

    protected static ?string $recordTitleAttribute = 'file_path';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('asset_type')
                        ->label('Tipe Media')
                        ->options([
                            'image' => 'Gambar',
                            'video' => 'Video (URL)',
                            'document' => 'Dokumen',
                            'link' => 'External Link',
                        ])
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn($set) => $set('file_path', null)),

                    // SOLUSI: Gunakan satu komponen yang dinamis atau pastikan state ditangani dengan benar
                    Forms\Components\FileUpload::make('file_path')
                        ->label('File Upload')
                        ->disk('public')
                        ->directory('portfolios')
                        ->visible(fn($get) => in_array($get('asset_type'), ['image', 'document']))
                        ->required(fn($get) => in_array($get('asset_type'), ['image', 'document']))
                        // Paksa state menjadi array untuk FileUpload agar tidak error foreach
                        ->afterStateHydrated(function (Forms\Components\FileUpload $component, $state) {
                            if (empty($state)) {
                                $component->state([]);
                            } elseif (is_string($state)) {
                                $component->state([$state]);
                            }
                        })
                        ->dehydrateStateUsing(fn($state) => is_array($state) ? collect($state)->first() : $state),

                    Forms\Components\TextInput::make('file_path')
                        ->label('URL / Link')
                        ->placeholder('https://...')
                        ->visible(fn($get) => in_array($get('asset_type'), ['video', 'link']))
                        ->required(fn($get) => in_array($get('asset_type'), ['video', 'link'])),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Toggle::make('is_thumbnail')
                            ->label('Thumbnail?'),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->size(50)
                    // Hapus jika error, atau gunakan closure safety
                    ->visibility(fn($record) => $record && $record->asset_type === 'image'),

                Tables\Columns\TextColumn::make('file_path_label')
                    ->label('Source')
                    ->getStateUsing(fn($record) => $record->asset_type === 'image' ? 'File: ' . basename($record->file_path) : $record->file_path)
                    ->limit(30),

                Tables\Columns\BadgeColumn::make('asset_type')
                    ->label('Tipe')
                    ->enum([
                        'image' => 'Gambar',
                        'video' => 'Video',
                        'document' => 'Dokumen',
                        'link' => 'Link',
                    ])
                    ->colors([
                        'primary' => 'image',
                        'warning' => 'video',
                        'success' => 'link',
                        'secondary' => 'document',
                    ]),

                Tables\Columns\IconColumn::make('is_thumbnail')
                    ->label('Thumb')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->falseIcon('heroicon-o-minus'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
