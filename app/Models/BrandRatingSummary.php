<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandRatingSummary extends Model
{
    protected $table = 'brand_ratings_summary';
    protected $primaryKey = 'brand_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'brand_id',
        'average_rating',
        'total_reviews',
        'last_updated'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
