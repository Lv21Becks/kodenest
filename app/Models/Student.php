<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'program',
        'learning_mode',
        'payment_status',
        'status',
        'progress',
        'address',
        'notes',
        'amount_paid',
    ];
}
