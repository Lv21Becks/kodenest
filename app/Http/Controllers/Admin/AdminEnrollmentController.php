<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Program; // For filter dropdown
use Illuminate\Http\Request;

class AdminEnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Stats
        $stats = [
            'pending' => Student::where('status', 'pending')->count(),
            'approved' => Student::where('status', 'active')->count(),
            'payment_due' => Student::where('payment_status', 'pending')->orWhere('payment_status', 'due')->count(),
            'rejected' => Student::where('status', 'rejected')->count(),
            'total' => Student::count(),
        ];

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('program')) {
            $query->where('program', $request->program);
        }

        if ($request->filled('status')) {
            if ($request->status === 'payment_due') {
                $query->where('payment_status', 'pending');
            } else {
                $query->where('status', $request->status);
            }
        } else {
            // Default view: Show pending first, then others
            // Or just latest?
            $query->orderByRaw("FIELD(status, 'pending') DESC")->latest();
        }

        $enrollments = $query->paginate(10)->withQueryString();
        $programs = Program::orderBy('title')->get();

        return view('admin.enrollments.index', compact('enrollments', 'stats', 'programs'));
    }

    public function approve(Student $student)
    {
        $student->update(['status' => 'active']);
        // Simulate sending email logic here if needed
        return back()->with('success', 'Enrollment approved successfully.');
    }

    public function reject(Student $student)
    {
        $student->update(['status' => 'rejected']);
        return back()->with('success', 'Enrollment rejected.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Enrollment record deleted.');
    }

    public function bulkApprove(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        Student::whereIn('id', $request->ids)->update(['status' => 'active']);
        return back()->with('success', count($request->ids) . ' enrollments approved.');
    }

    public function bulkReject(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        Student::whereIn('id', $request->ids)->update(['status' => 'rejected']);
        return back()->with('success', count($request->ids) . ' enrollments rejected.');
    }
}
