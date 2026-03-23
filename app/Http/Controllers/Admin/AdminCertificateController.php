<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Student;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::with(['student', 'course'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            })->orWhere('certificate_code', 'like', "%{$search}%");
        }

        $certificates = $query->paginate(15)->withQueryString();

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        $students = Student::orderBy('first_name')->get();
        $programs = Program::orderBy('title')->get();
        return view('admin.certificates.create', compact('students', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:programs,slug',
            'issued_at' => 'required|date',
        ]);

        $validated['certificate_code'] = 'KN-' . strtoupper(Str::random(10));
        $validated['issued_by'] = auth()->id();
        $validated['verification_url'] = route('home') . '/verify/' . $validated['certificate_code'];

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate issued successfully.');
    }

    public function show(Certificate $certificate)
    {
        return view('admin.certificates.show', compact('certificate'));
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate revoked successfully.');
    }
}
