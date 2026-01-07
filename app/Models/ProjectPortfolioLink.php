<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPortfolioLink extends Model
{
    protected $table = 'project_portfolio_link';

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'portfolio_id',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
}
