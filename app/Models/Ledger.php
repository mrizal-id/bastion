<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $table = 'ledger';

    const UPDATED_AT = null;


    protected $keyType = 'string';
    public $incrementing = false;

    // Kolom yang dapat diisi (Mass Assignable)
    protected $fillable = [
        'id',
        'account_id',
        'type',
        'amount',
        'balance_after',
        'idempotency_key',
        'reference_type',
        'reference_id',
        'created_at',
    ];

    // Kolom yang harus di-cast ke tipe tertentu (untuk pemrosesan lebih lanjut)
    protected $casts = [
        'amount' => 'decimal:4',
        'balance_after' => 'decimal:4',
        'created_at' => 'datetime',
    ];

    // Relasi dengan Account
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    // Fungsi untuk mendapatkan tipe transaksi (Debit/Credit)
    public function getTypeAttribute($value)
    {
        return ucfirst($value);  // Capitalize the first letter (Debit -> Debit, Credit -> Credit)
    }


    // Menambahkan scope atau fungsi-fungsi tambahan sesuai kebutuhan
    public function scopeDebits($query)
    {
        return $query->where('type', 'debit');
    }

    public function scopeCredits($query)
    {
        return $query->where('type', 'credit');
    }
}
