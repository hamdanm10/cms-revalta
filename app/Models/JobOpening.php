<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'work_type',
        'status',
        'slug',
    ];

    protected $casts = [
        'work_type' => 'string',
        'status'    => 'string',
    ];
}
