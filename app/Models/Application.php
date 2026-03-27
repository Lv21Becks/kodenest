<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'applicant_id',
        'program_id',
        'learning_mode',
        'status',
        'rejection_reason',
        'notes',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function enrollment()
    {
        return $this->hasOne(Enrollment::class);
    }
}
