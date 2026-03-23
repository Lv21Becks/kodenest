<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'total_amount',
        'amount_paid',
        'balance',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Program::class, 'course_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
