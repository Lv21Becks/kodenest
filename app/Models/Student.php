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
        'address',
        'notes',
    ];

    const STATUS_ACTIVE = 'Active';
    const STATUS_SUSPENDED = 'Suspended';
    const STATUS_ALUMNI = 'Alumni';

    protected static function booted()
    {
        static::updated(function ($student) {
            if ($student->wasChanged('status')) {
                \App\Models\StudentStatusLog::create([
                    'student_id' => $student->id,
                    'old_status' => $student->getOriginal('status'),
                    'new_status' => $student->status,
                    'user_id' => auth()->id() ?? null, // using user_id instead of changed_by because of the DB schema
                    'reason' => request()->input('status_reason', null),
                ]);
            }
        });
    }

    public function statusLogs()
    {
        return $this->hasMany(StudentStatusLog::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
