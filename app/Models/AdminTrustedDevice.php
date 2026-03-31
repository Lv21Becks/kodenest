<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTrustedDevice extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'last_used_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
