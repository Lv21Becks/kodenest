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
}
