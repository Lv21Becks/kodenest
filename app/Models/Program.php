<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'duration',
        'target_audience',
        'skills',
        'tools',
        'price',
        'image_icon',
        'status',
        'coming_soon',
        'order'
    ];

    protected $casts = [
        'skills' => 'array',
        'tools' => 'array',
        'status' => 'boolean',
        'coming_soon' => 'boolean',
        'price' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('order');
    }
}
