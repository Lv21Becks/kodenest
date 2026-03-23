<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Program;
use Illuminate\Http\Request;

class AdminEnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['student', 'program']);

        // Stats
        $stats = [
            'active' => Enrollment::where('status', 'active')->count(),
            'completed' => Enrollment::where('status', 'completed')->count(),
            'at_risk' => \App\Models\Invoice::whereIn('status', ['unpaid', 'partial'])->distinct('student_id')->count(),
            'total' => Enrollment::count(),
        ];

        // Route-based filtering (Alumni)
        if ($request->routeIs('admin.alumni.index')) {
            $query->where('status', 'completed');
        }

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('at_risk')) {
            $atRiskIds = \App\Models\Invoice::whereIn('status', ['unpaid', 'partial'])->pluck('student_id');
            $query->whereIn('student_id', $atRiskIds);
        }

        if ($request->filled('program')) {
            $query->where('program_id', $request->program);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else if (!$request->routeIs('admin.alumni.index')) {
            $query->latest();
        }

        $enrollments = $query->paginate(15)->withQueryString();
        $programs = Program::orderBy('title')->get();

        return view('admin.enrollments.index', compact('enrollments', 'stats', 'programs'));
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return back()->with('success', 'Enrollment record deleted.');
    }
}
