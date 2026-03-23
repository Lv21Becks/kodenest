<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'program_id',
        'application_id',
        'status',
        'progress',
        'enrollment_date',
        'completion_date',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_SUSPENDED = 'suspended';
    const STATUS_DROPPED = 'dropped';

    protected $casts = [
        'enrollment_date' => 'datetime',
        'completion_date' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'slug');
    }
}
