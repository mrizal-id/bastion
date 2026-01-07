<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id', 'user_id', 'balance', 'currency', 'version'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ledgers()
    {
        return $this->hasMany(Ledger::class, 'account_id');
    }
}
