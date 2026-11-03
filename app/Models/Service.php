<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'number',
        'title',
        'tagline',
        'description',
        'deliverables',
        'order',
    ];

    protected $casts = [
        'deliverables' => 'array',
    ];
}

