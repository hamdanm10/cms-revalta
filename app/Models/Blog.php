<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'thumbnail',
        'short_description',
        'keywords',
        'content',
        'status',
        'published_at',
        'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
