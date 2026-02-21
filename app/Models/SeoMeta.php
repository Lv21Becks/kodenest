<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'item_id',
        'route_name',
        'page',
        'title',
        'description',
        'keywords',
        'og_image'
    ];

    public static function getForPage($page)
    {
        return static::where('page', $page)->first();
    }
}
