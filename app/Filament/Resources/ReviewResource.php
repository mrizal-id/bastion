<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Reputation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('project_id')
                        ->relationship('project', 'id')
                        ->disabled(), // Review biasanya tidak diubah projectnya

                    Forms\Components\Select::make('reviewer_id')
                        ->relationship('reviewer', 'name')
                        ->disabled(),

                    Forms\Components\TextInput::make('rating_score')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5)
                        ->required(),

                    Forms\Components\Textarea::make('comment')
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('is_hidden')
                        ->label('Sembunyikan Review')
                        ->helperText('Jika aktif, review tidak akan muncul di profil publik brand.'),
                ])->columns(2),

                Forms\Components\Card::make()->schema([
                    Forms\Components\Placeholder::make('Reply Section'),
                    Forms\Components\Textarea::make('reply_comment')
                        ->label('Balasan Brand'),
                    Forms\Components\DateTimePicker::make('replied_at')
                        ->label('Waktu Balasan'),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reviewer.name')
                    ->label('Reviewer')
                    ->searchable(),

                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->searchable(),

                Tables\Columns\IconColumn::make('rating_score')
                    ->label('Rating')
                    ->options([
                        'heroicon-s-star' => fn($state): bool => $state >= 1,
                    ])
                    ->colors([
                        'warning' => fn($state): bool => $state >= 1,
                    ]),

                Tables\Columns\BooleanColumn::make('is_hidden')
                    ->label('Hidden'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_hidden'),
                Tables\Filters\TrashedFilter::make(), // WAJIB untuk Soft Deletes di Filament v2
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(), // Aksi untuk memulihkan review
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
