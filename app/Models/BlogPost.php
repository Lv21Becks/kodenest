<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'author',
        'featured_image',
        'read_time',
        'published',
        'published_at'
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
        'read_time' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }

    /**
     * Returns the correct public URL for the blog post image.
     * Supports both admin-uploaded images (via storage) and
     * static seeded images in public/images (prefixed with 'public:').
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->featured_image) return null;
        if (str_starts_with($this->featured_image, 'public:')) {
            return asset(substr($this->featured_image, 7));
        }
        return asset('storage/' . $this->featured_image);
    }
}
