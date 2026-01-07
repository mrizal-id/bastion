<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use App\Services\TransactionService;
use Filament\Notifications\Notification;
use Exception;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';
    protected static ?string $navigationGroup = 'Operations';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->required(),

                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('total_budget')
                    ->numeric()
                    ->prefix('IDR')
                    ->required(),

                Select::make('project_status')
                    ->options([
                        'draft' => 'Draft',
                        'active' => 'Active',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])->required(),

                Select::make('escrow_status')
                    ->options([
                        'none' => 'None',
                        'held' => 'Money Held (Escrow)',
                        'released' => 'Released to Brand',
                        'disputed' => 'In Dispute',
                        'refunded' => 'Refunded to Client',
                    ])->required(),
            ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')->label('Client')->searchable(),
                TextColumn::make('brand.name')->label('Brand')->searchable(),

                TextColumn::make('total_budget')
                    ->money('idr', true)
                    ->sortable(),

                BadgeColumn::make('project_status')
                    ->colors([
                        'secondary' => 'draft',
                        'primary' => 'active',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),

                BadgeColumn::make('escrow_status')
                    ->colors([
                        'warning' => 'held',
                        'success' => 'released',
                        'danger' => 'disputed',
                        'secondary' => 'refunded',
                    ]),
            ])
            ->actions([
                // ACTION: RELEASE PAYMENT
                Tables\Actions\Action::make('release_payment')
                    ->label('Cairkan Dana')
                    ->icon('heroicon-o-cash')
                    ->color('success')
                    ->requiresConfirmation()
                    // Hanya muncul jika status dana sedang ditahan (held)
                    ->visible(fn($record) => $record->escrow_status === 'held')
                    ->action(function ($record) {
                        try {
                            // Validasi: Pastikan Brand Owner punya akun
                            $account = $record->brand->owner->account;

                            if (!$account) {
                                throw new Exception("Owner Brand belum memiliki akun finansial.");
                            }

                            // Eksekusi pemindahan saldo via Service
                            TransactionService::process(
                                $account->id,
                                'credit',
                                $record->total_budget,
                                'PROJECT_RELEASE',
                                $record->id
                            );

                            // Update status proyek di database
                            $record->update(['escrow_status' => 'released', 'project_status' => 'completed']);

                            Notification::make()
                                ->title('Pembayaran Berhasil Dicairkan!')
                                ->body('Saldo telah ditambahkan ke akun owner brand.')
                                ->success()
                                ->send();
                        } catch (Exception $e) {
                            Notification::make()
                                ->title('Gagal Mencairkan Dana')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
