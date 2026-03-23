<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Program;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Applicant;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with('applicant');

        // Stats
        $stats = [
            'pending' => Application::where('status', 'pending')->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
            'total' => Application::count(),
            'this_month' => Application::whereMonth('created_at', now()->month)->count(),
        ];

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('applicant', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('program')) {
            $query->where('program_id', $request->program);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            // Default view: Show pending first
            $query->orderByRaw("FIELD(status, 'pending') DESC")->latest();
        }

        $applications = $query->paginate(15)->withQueryString();
        $programs = Program::orderBy('title')->get();

        return view('admin.applications.index', compact('applications', 'stats', 'programs'));
    }

    public function approve(Application $application)
    {
        $application->status = Application::STATUS_APPROVED;
        $application->save();

        $applicant = $application->applicant;

        // 1. Find or Create Student record
        $student = Student::firstOrCreate(
            ['email' => $applicant->email],
            [
                'first_name' => $applicant->first_name,
                'last_name' => $applicant->last_name,
                'phone' => $applicant->phone,
                'address' => $applicant->address,
                'notes' => 'Created from application #' . $application->id,
            ]
        );

        // 2. Create Enrollment
        Enrollment::create([
            'student_id' => $student->id,
            'program_id' => $application->program_id,
            'application_id' => $application->id,
            'status' => Enrollment::STATUS_ACTIVE,
            'progress' => 0,
            'enrollment_date' => now(),
        ]);

        return back()->with('success', 'Application approved! Student record linked and enrollment created.');
    }

    public function reject(Request $request, Application $application)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $application->update([
            'status' => Application::STATUS_REJECTED,
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'Application rejected with reason.');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return back()->with('success', 'Application record deleted.');
    }

    public function bulkApprove(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:applications,id'
        ]);

        $applications = Application::with('applicant')->whereIn('id', $request->ids)->get();

        foreach ($applications as $application) {
            $application->status = Application::STATUS_APPROVED;
            $application->save();

            $applicant = $application->applicant;

            // Find or Create Student
            $student = Student::firstOrCreate(
                ['email' => $applicant->email],
                [
                    'first_name' => $applicant->first_name,
                    'last_name' => $applicant->last_name,
                    'phone' => $applicant->phone,
                    'address' => $applicant->address,
                ]
            );

            // Create Enrollment
            Enrollment::create([
                'student_id' => $student->id,
                'program_id' => $application->program_id,
                'application_id' => $application->id,
                'status' => Enrollment::STATUS_ACTIVE,
                'progress' => 0,
                'enrollment_date' => now(),
            ]);
        }

        return back()->with('success', count($applications) . ' applications approved and students enrolled successfully.');
    }

    public function bulkReject(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:applications,id',
            'rejection_reason' => 'required|string'
        ]);

        Application::whereIn('id', $request->ids)->update([
            'status' => Application::STATUS_REJECTED,
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', count($request->ids) . ' applications rejected successfully.');
    }
}
