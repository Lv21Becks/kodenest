<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'cohort_id',
        'status',
        'progress',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Program::class, 'course_id');
    }

    // public function cohort()
    // {
    //     return $this->belongsTo(Cohort::class);
    // }
}
