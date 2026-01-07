<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Ledger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class TransactionService
{
    /**
     * Inti dari sistem Bastion: Atomic Transaction
     */
    public static function process(string $accountId, string $type, float $amount, string $refType, string $refId)
    {
        return DB::transaction(function () use ($accountId, $type, $amount, $refType, $refId) {

            // 1. Lock Account untuk mencegah Race Condition (Pessimistic Locking)
            $account = Account::where('id', $accountId)->lockForUpdate()->first();

            if (!$account) throw new Exception("Account tidak ditemukan.");

            // 2. Validasi saldo jika uang keluar (debit)
            if ($type === 'debit' && $account->balance < $amount) {
                throw new Exception("Saldo tidak mencukupi untuk transaksi ini.");
            }

            // 3. Hitung saldo baru
            $oldBalance = (float) $account->balance;
            $newBalance = ($type === 'credit') ? ($oldBalance + $amount) : ($oldBalance - $amount);

            // 4. Update Saldo Account
            $account->update([
                'balance' => $newBalance,
                'last_transaction_id' => (string) Str::uuid(), // ID unik untuk chain verifikasi
            ]);

            // 5. Catat ke Ledger (Immutable Record)
            return Ledger::create([
                'id' => (string) Str::uuid(),
                'account_id' => $account->id,
                'type' => $type,
                'amount' => $amount,
                'balance_after' => $newBalance,
                'idempotency_key' => "TX-" . strtoupper(Str::random(12)), // Mencegah double proses
                'reference_type' => $refType,
                'reference_id' => $refId,
            ]);
        });
    }
}
