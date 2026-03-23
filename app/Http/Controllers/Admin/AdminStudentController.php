<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = \App\Models\Student::with(['enrollments.program'])->latest();

        // Filters
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (request('program')) {
            $query->whereHas('enrollments', function ($q) {
                $q->where('program_id', request('program'));
            });
        }

        if (request('status')) {
            $query->whereHas('enrollments', function ($q) {
                $q->where('status', request('status'));
            });
        }

        $students = $query->paginate(10);

        // Stats
        $stats = [
            'total_people' => \App\Models\Student::count(),
            'total_enrollments' => \App\Models\Enrollment::count(),
            'active_people' => \App\Models\Enrollment::where('status', 'active')->distinct('student_id')->count(),
            'new_this_week' => \App\Models\Student::where('created_at', '>=', now()->startOfWeek())->count(),
            'at_risk' => \App\Models\Invoice::whereIn('status', ['unpaid', 'partial'])->distinct('student_id')->count(),
            'graduated' => \App\Models\Enrollment::where('status', 'completed')->distinct('student_id')->count(),
        ];

        $programs = \App\Models\Program::orderBy('title')->get();

        return view('admin.students.index', compact('students', 'stats', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Student $student)
    {
        $programs = \App\Models\Program::orderBy('title')->get();
        return view('admin.students.edit', compact('student', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        \App\Models\Student::create($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Student $student)
    {
        // 1. Profile (Student info) - already in $student

        // 2. Program Info (Enrollments)
        $enrollments = $student->enrollments()->with('program')->latest()->get();

        // 3. Performance (Progress/Risk)
        // Check for unpaid invoices to determine risk level
        $hasUnpaid = \App\Models\Invoice::where('student_id', $student->id)
            ->whereIn('status', ['unpaid', 'partial'])
            ->exists();
        
        $riskLevel = $hasUnpaid ? 'high' : 'low';

        // 4. Payments
        $invoices = \App\Models\Invoice::where('student_id', $student->id)->latest()->get();
        $outstandingBalance = $invoices->whereIn('status', ['unpaid', 'partial'])->sum('balance');

        return view('admin.students.show', compact('student', 'enrollments', 'riskLevel', 'invoices', 'outstandingBalance'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
