<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    use HasUuid;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['owner_id', 'name', 'slug', 'is_verified', 'daily_limit'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) $model->id = (string) Str::uuid();
            if (empty($model->slug)) $model->slug = Str::slug($model->name);
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function publishedPortfolios()
    {
        return $this->hasMany(Portfolio::class)->where('is_published', true);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function ratingSummary(): HasOne
    {
        return $this->hasOne(BrandRatingSummary::class, 'brand_id');
    }
}
