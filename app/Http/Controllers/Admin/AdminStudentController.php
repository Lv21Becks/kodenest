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
        // Subquery to get the latest student ID for each email
        // This ensures we have one record per person (the most recent one)
        $latestIds = \App\Models\Student::selectRaw('MAX(id) as id')
            ->groupBy('email');

        $query = \App\Models\Student::whereIn('id', $latestIds)->latest();

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
            $query->where('program', request('program'));
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $students = $query->paginate(10);

        // Hydrate with entire history
        $students->getCollection()->transform(function ($student) {
            $history = \App\Models\Student::where('email', $student->email)->latest()->get();
            $student->history = $history;
            $student->enrollments_count = $history->count();
            // Check if ANY enrollment is active
            $student->has_active_enrollment = $history->contains('status', 'active');
            return $student;
        });

        // Stats
        $stats = [
            'total_people' => \App\Models\Student::distinct('email')->count(),
            'total_enrollments' => \App\Models\Student::count(),
            'active_people' => \App\Models\Student::where('status', 'active')->distinct('email')->count(),
            'new_this_week' => \App\Models\Student::where('created_at', '>=', now()->startOfWeek())->distinct('email')->count(),
            'at_risk' => \App\Models\Student::where('payment_status', 'pending')->distinct('email')->count(),
            'graduated' => \App\Models\Student::where('status', 'completed')->distinct('email')->count(),
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
            'program' => 'required|string',
            'learning_mode' => 'required|string',
            'payment_status' => 'required|string',
            'amount_paid' => 'required|numeric|min:0',
            'status' => 'required|string',
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
            'program' => 'required|string',
            'learning_mode' => 'required|string',
            'payment_status' => 'required|string',
            'amount_paid' => 'nullable|numeric|min:0',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if (!isset($validated['amount_paid'])) {
            $validated['amount_paid'] = 0;
        }

        \App\Models\Student::create($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');
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
