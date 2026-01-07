<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use SoftDeletes, LogsActivity;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'client_id',
        'brand_id',
        'category',
        'total_budget',
        'project_status',
        'escrow_status',
        'version'
    ];

    protected $casts = [
        'total_budget' => 'decimal:4',
        'version' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });

        static::updating(function ($model) {
            $model->version++;
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('project_audit');
    }

    /**
     * Relasi ke Portfolio (One-to-One)
     * Karena sekarang project_id ada di tabel portfolios
     */
    public function portfolio(): HasOne
    {
        return $this->hasOne(Portfolio::class, 'project_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Relasi ke Review (One-to-One) - Fase 6
     */
    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'project_id');
    }
}
