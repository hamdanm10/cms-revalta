<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'short_description',
        'description',
        'thumbnail',
        'slug',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }
}
