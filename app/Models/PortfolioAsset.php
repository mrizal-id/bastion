<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class PortfolioAsset extends Model
{
    use HasUuid;

    protected $fillable = [
        'portfolio_id',
        'asset_type',
        'file_path',
        'is_thumbnail',
        'sort_order'
    ];

    protected $casts = [
        'is_thumbnail' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Logika Otomatis: Pastikan hanya ada satu thumbnail per portfolio
    protected static function booted()
    {
        static::saving(function ($asset) {
            if ($asset->is_thumbnail) {
                // Set thumbnail lain milik portfolio ini menjadi false
                static::where('portfolio_id', $asset->portfolio_id)
                    ->where('id', '!=', $asset->id)
                    ->update(['is_thumbnail' => false]);
            }
        });
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
