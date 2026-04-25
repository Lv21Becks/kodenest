<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'position',
        'content',
        'rating',
        'featured',
        'image',
        'order',
        'status'
    ];

    protected $casts = [
        'rating' => 'integer',
        'featured' => 'boolean',
        'status' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true)->where('status', true);
    }

    /**
     * Returns the correct public URL for the testimonial photo.
     * Supports both admin-uploaded images (via storage) and
     * static seeded images in public/images (prefixed with 'public:').
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'public:')) {
            $path = substr($this->image, 7);
            $v = file_exists(public_path($path)) ? filemtime(public_path($path)) : 1;
            return asset($path) . '?v=' . $v;
        }
        $storagePath = 'storage/' . $this->image;
        $v = file_exists(public_path($storagePath)) ? filemtime(public_path($storagePath)) : 1;
        return asset($storagePath) . '?v=' . $v;
    }
}
