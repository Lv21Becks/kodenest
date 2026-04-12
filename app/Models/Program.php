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

    /**
     * Returns the correct public URL for the program image.
     * Supports both admin-uploaded images (via storage) and
     * static seeded images in public/images (prefixed with 'public:').
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->image_icon) return null;
        if (str_starts_with($this->image_icon, 'public:')) {
            return asset(substr($this->image_icon, 7));
        }
        return asset('storage/' . $this->image_icon);
    }
}
