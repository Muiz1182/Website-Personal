<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'category',
        'tag',
        'year',
        'specs',
        'description',
        'image',
        'span',
        'aspect',
        'order',
        'status',
    ];

    /**
     * Hapus berkas gambar fisik dari storage VPS saat data dihapus permanen.
     */
    protected static function booted()
    {
        static::deleting(function (Project $project) {
            if ($project->image && str_starts_with($project->image, '/uploads/')) {
                $filePath = public_path(ltrim($project->image, '/'));
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
        });
    }
}

