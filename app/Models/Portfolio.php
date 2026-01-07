<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'brand_id',
        'project_id',
        'title',
        'slug',
        'description',
        'tags',
        'live_url',
        'is_published',
        'view_count'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'view_count' => 'integer',
    ];

    /**
     * Relasi ke Brand
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relasi ke Project (Sumber Kategori Utama)
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Accessor: Mendapatkan kategori secara otomatis
     * Memanggil kategori dari Project jika ada, atau fallback ke tag pertama
     */
    public function getCategoryAttribute(): string
    {
        if ($this->project_id && $this->project) {
            // Mengambil label kategori dari enum project
            return str_replace('_', ' ', ucfirst($this->project->category));
        }

        // Jika upload manual, ambil dari tag pertama atau 'General'
        return $this->tags[0] ?? 'General';
    }

    public function assets()
    {
        return $this->hasMany(PortfolioAsset::class)->orderBy('sort_order', 'asc');
    }

    public function thumbnail()
    {
        return $this->hasOne(PortfolioAsset::class)->where('is_thumbnail', true);
    }
}
