<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'status',
    ];

    /**
     * Get the applications for the applicant.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
