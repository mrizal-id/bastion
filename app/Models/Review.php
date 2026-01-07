<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Review extends Model
{
    use HasUuid, SoftDeletes, LogsActivity;

    protected $fillable = [
        'project_id',
        'reviewer_id',
        'brand_id',
        'rating_score',
        'comment',
        'professionalism_score',
        'quality_score',
        'communication_score',
        'reply_comment',
        'replied_at',
        'is_hidden'
    ];

    protected $casts = [
        'rating_score' => 'integer',
        'professionalism_score' => 'integer',
        'quality_score' => 'integer',
        'communication_score' => 'integer',
        'is_hidden' => 'boolean',
        'replied_at' => 'datetime',
    ];

    /**
     * Konfigurasi Log Aktivitas (Spatie)
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('review_audit');
    }

    /**
     * Relasi ke Project (Satu review hanya untuk satu project selesai)
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relasi ke User yang memberikan review (Client)
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Relasi ke Brand yang menerima review
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Scope untuk hanya menampilkan review yang tidak disembunyikan
     */
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }
}
