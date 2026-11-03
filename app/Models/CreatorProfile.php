<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreatorProfile extends Model
{
    protected $fillable = [
        'name',
        'role',
        'headline',
        'bio',
        'image',
        'lanyard_image',
        'disciplines',
        'stats',
    ];

    protected $casts = [
        'disciplines' => 'array',
        'stats' => 'array',
    ];
}

