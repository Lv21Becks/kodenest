<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentStatusLog extends Model
{
    protected $fillable = [
        'student_id',
        'old_status',
        'new_status',
        'user_id',
        'reason',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
