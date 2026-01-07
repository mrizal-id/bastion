<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Card::make()->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Portfolio::class, 'slug', ignoreRecord: true),

                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('tags')
                            ->placeholder('Tambah tag...')
                            ->helperText('Gunakan koma atau enter untuk memisahkan tag'),

                        Forms\Components\TextInput::make('live_url')
                            ->url()
                            ->label('Project URL (Live)')
                            ->placeholder('https://example.com'),
                    ])->columns(2),
                ])->columnSpan(2),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Card::make()->schema([
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn($set) => $set('project_id', null)),

                        Forms\Components\Select::make('project_id')
                            ->label('Linked Project')
                            ->placeholder('Pilih project (opsional)')
                            ->options(function ($get) {
                                $brandId = $get('brand_id');
                                if (! $brandId) return [];

                                return \App\Models\Project::where('brand_id', $brandId)
                                    ->pluck('id', 'id');
                            })
                            ->searchable()
                            ->reactive() // Reactive agar placeholder kategori di bawah terupdate
                            ->helperText('Hanya menampilkan project milik brand terpilih'),

                        // REVISI: Menampilkan kategori dari project secara dinamis (Read-only)
                        Forms\Components\Placeholder::make('project_category')
                            ->label('Category (Auto)')
                            ->content(function ($get) {
                                $projectId = $get('project_id');
                                if (!$projectId) return 'N/A (External Upload)';

                                $project = \App\Models\Project::find($projectId);
                                return $project ? str_replace('_', ' ', ucfirst($project->category)) : 'N/A';
                            }),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Published Status')
                            ->onIcon('heroicon-s-check')
                            ->offIcon('heroicon-s-x')
                            ->default(false),

                        Forms\Components\Placeholder::make('view_count')
                            ->label('Total Views')
                            ->content(fn($record): string => $record ? number_format($record->view_count) : '0'),
                    ]),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail.file_path')
                    ->label('Thumb')
                    ->disk('public')
                    ->size(40),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable(),

                // REVISI: Mengambil kategori dari Accessor Model Portfolio
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->getStateUsing(fn($record) => $record->category),

                Tables\Columns\BadgeColumn::make('is_published')
                    ->label('Status')
                    ->enum([
                        0 => 'Draft',
                        1 => 'Published',
                    ])
                    ->colors([
                        'secondary' => 0,
                        'success' => 1,
                    ]),

                Tables\Columns\TextColumn::make('view_count')
                    ->label('Views')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('brand_id')
                    ->relationship('brand', 'name')
                    ->label('Filter by Brand'),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Only'),
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
            RelationManagers\AssetsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Category_id sudah dihapus dari with()
        return parent::getEloquentQuery()
            ->with(['brand', 'thumbnail', 'project'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
