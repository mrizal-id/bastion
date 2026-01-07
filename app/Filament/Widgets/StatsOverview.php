<?php

namespace App\Filament\Widgets;

use App\Models\Account;
use App\Models\Project;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Dana di Escrow', 'IDR ' . number_format(Account::sum('balance'), 0, ',', '.'))
                ->description('Total saldo seluruh wallet user')
                ->descriptionIcon('heroicon-s-cash')
                ->color('success'),

            Card::make('Proyek Aktif', Project::where('project_status', 'active')->count())
                ->description('Proyek yang sedang berjalan')
                ->descriptionIcon('heroicon-s-clipboard-list')
                ->color('primary'),

            Card::make('Total User', User::count())
                ->description('User terdaftar di sistem')
                ->descriptionIcon('heroicon-s-users')
                ->color('warning'),
        ];
    }
}
