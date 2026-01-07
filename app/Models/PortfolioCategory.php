<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    // Relasi balik: Satu kategori memiliki banyak portfolio
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'category_id');
    }
}
