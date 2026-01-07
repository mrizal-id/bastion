<?php

namespace App\Filament\Resources\AccountResource\Widgets;

use App\Models\Account;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class AccountStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Liquidity', 'IDR ' . number_format(Account::sum('balance'), 0, ',', '.'))
                ->description('Total uang di seluruh akun user')
                ->descriptionIcon('heroicon-s-library')
                ->color('success'),

            Card::make('Avg. Balance', 'IDR ' . number_format(Account::avg('balance'), 0, ',', '.'))
                ->description('Rata-rata saldo per user')
                ->color('primary'),

            Card::make('Active Accounts', Account::count())
                ->description('Jumlah dompet terdaftar')
                ->color('warning'),
        ];
    }
}
