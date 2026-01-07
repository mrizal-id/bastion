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
use Illuminate\Database\Eloquent\Builder;
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

                // ADDED: Project Category Enum
                Select::make('category')
                    ->options([
                        'web_development' => 'Web Development',
                        'mobile_development' => 'Mobile Development',
                        'design_creative' => 'Design & Creative',
                        'writing_translation' => 'Writing & Translation',
                        'marketing_sales' => 'Marketing & Sales',
                        'video_animation' => 'Video & Animation',
                        'other' => 'Other',
                    ])
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

                // ADDED: Category Column
                TextColumn::make('category')
                    ->enum([
                        'web_development' => 'Web Dev',
                        'mobile_development' => 'Mobile Dev',
                        'design_creative' => 'Design',
                        'writing_translation' => 'Writing',
                        'marketing_sales' => 'Marketing',
                        'video_animation' => 'Video',
                        'other' => 'Other',
                    ])->sortable(),

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
                    ->modalHeading('Konfirmasi Pencairan Dana')
                    ->modalSubheading('Tindakan ini akan memindahkan saldo ke akun pemilik Brand. Pastikan pekerjaan telah diverifikasi.')
                    ->visible(fn($record) => $record->escrow_status === 'held' && $record->project_status !== 'completed')
                    ->action(function ($record) {
                        try {
                            // Validasi Akun Finansial Owner Brand
                            $owner = $record->brand->owner;
                            $account = $owner->account;

                            if (!$account) {
                                throw new Exception("Owner Brand ({$owner->name}) belum memiliki akun finansial.");
                            }

                            // Eksekusi pemindahan saldo via Service (Atomatic & Immutable)
                            TransactionService::process(
                                $account->id,
                                'credit',
                                $record->total_budget,
                                'project_payment', // Sesuai reference_type di tabel ledger
                                $record->id
                            );

                            // Update status proyek secara atomik
                            $record->update([
                                'escrow_status' => 'released',
                                'project_status' => 'completed',
                                'version' => $record->version + 1 // Manual increment jika tidak lewat boot
                            ]);

                            Notification::make()
                                ->title('Pembayaran Berhasil Dicairkan!')
                                ->body("Saldo sebesar IDR " . number_format($record->total_budget) . " telah masuk ke akun " . $owner->name)
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

    public static function getEloquentQuery(): Builder
    {
        // Optimasi N+1: Memuat relasi yang dibutuhkan untuk aksi Release Payment
        return parent::getEloquentQuery()
            ->with(['brand.owner.account', 'client']);
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
