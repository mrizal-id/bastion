<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'security_level',
        'last_ip_address',
        'device_fingerprint',
        'version'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Boot function untuk handle UUID dan Versioning otomatis
    protected static function boot()
    {
        parent::boot();

        // Otomatis buat UUID saat User dibuat
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        // Anti-Race Condition: Naikkan versi tiap kali data diupdate
        static::updating(function ($model) {
            $model->version++;
        });
    }

    public function account()
    {
        // User punya satu Account (Finansial)
        return $this->hasOne(Account::class, 'user_id');
    }
}
