<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'badge',
        'content',
        'action_text',
        'action_url',
        'status',
        'is_active',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'starts_at'  => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Scope untuk pengumuman yang aktif dan terbit.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->latest('id');
    }
}

