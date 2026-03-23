<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $query = Program::query();

        // Search Filter
        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        // Status Filter
        if (request()->has('status') && request('status') !== null) {
            $query->where('status', request('status'));
        }

        $programs = $query->orderBy('order')->get()->map(function ($program) {
            // Count students enrolled in this program via Enrollments table
            $studentCount = \App\Models\Enrollment::where('program_id', $program->slug)->count();

            $program->student_count = $studentCount;
            $program->revenue = $studentCount * $program->price;
            
            // Completion Rate: Average progress of students in this program
            $avgProgress = \App\Models\Enrollment::where('program_id', $program->slug)->avg('progress');
            $program->completion_rate = $avgProgress ? round($avgProgress) : 0;

            // Growth: New enrollments this month vs last month
            $thisMonth = \App\Models\Enrollment::where('program_id', $program->slug)
                ->where('created_at', '>=', now()->startOfMonth())
                ->count();
            $lastMonth = \App\Models\Enrollment::where('program_id', $program->slug)
                ->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
                ->count();

            if ($lastMonth > 0) {
                $growth = (($thisMonth - $lastMonth) / $lastMonth) * 100;
            } else {
                $growth = $thisMonth > 0 ? 100 : 0; // 100% growth if started from 0, else 0%
            }
            $program->growth = round($growth);

            // Rating: Currently using global testimonial average as placeholders 
            $program->rating = round(\App\Models\Testimonial::avg('rating') ?? 5.0, 1);

            return $program;
        });

        // Overall Stats
        $stats = [
            'total_programs' => $programs->count(),
            'total_enrollments' => $programs->sum('student_count'),
            'total_revenue' => $programs->sum('revenue'),
            'avg_rating' => 4.9,
        ];

        return view('admin.programs.index', compact('programs', 'stats'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'target_audience' => 'required|string',
            'skills' => 'required|string',
            'tools' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
            'coming_soon' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['skills'] = explode(',', $validated['skills']);
        $validated['tools'] = $request->filled('tools') ? explode(',', $validated['tools']) : [];
        $validated['status'] = $request->has('status');
        $validated['coming_soon'] = $request->has('coming_soon');

        if ($request->hasFile('image_icon')) {
            $validated['image_icon'] = $request->file('image_icon')->store('programs', 'public');
        }

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully!');
    }

    public function edit(Program $program)
    {
        // Hub Data
        // Corrected: Count students via Enrollments relationship
        $enrollmentCount = \App\Models\Enrollment::where('program_id', $program->slug)->count();

        $seoRecord = \App\Models\SeoMeta::where('route_name', 'programs.show')
            ->where('item_id', $program->id)
            ->first();

        // Placeholder for features
        $featureCount = 0;

        return view('admin.programs.edit', compact('program', 'enrollmentCount', 'seoRecord', 'featureCount'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'target_audience' => 'required|string',
            'skills' => 'required|string',
            'tools' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
            'coming_soon' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['skills'] = is_array($validated['skills']) ? $validated['skills'] : explode(',', $validated['skills']);
        $validated['tools'] = $request->filled('tools') ? (is_array($validated['tools']) ? $validated['tools'] : explode(',', $validated['tools'])) : [];
        $validated['status'] = $request->has('status');
        $validated['coming_soon'] = $request->has('coming_soon');

        if ($request->hasFile('image_icon')) {
            // Delete old image if exists
            if ($program->image_icon && \Illuminate\Support\Facades\Storage::disk('public')->exists($program->image_icon)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($program->image_icon);
            }
            $validated['image_icon'] = $request->file('image_icon')->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program updated successfully!');
    }

    public function show(Program $program)
    {
        $applications = \App\Models\Application::with('applicant')
            ->where('program_id', $program->slug)
            ->latest()
            ->get();

        $enrollments = \App\Models\Enrollment::with('student')
            ->where('program_id', $program->slug)
            ->latest()
            ->get();

        return view('admin.programs.show', compact('program', 'applications', 'enrollments'));
    }

    public function destroy(Program $program)
    {
        // Check for students (enrollments)
        if (\App\Models\Enrollment::where('program_id', $program->slug)->exists()) {
            return redirect()->back()->with('error', 'Cannot delete program with active students. Deactivate it instead.');
        }

        // Check for applications
        if (\App\Models\Application::where('program_id', $program->slug)->exists()) {
            return redirect()->back()->with('error', 'Cannot delete program with existing applications. Deactivate it instead.');
        }

        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }

    public function toggleStatus(Program $program)
    {
        $program->status = !$program->status;
        $program->save();

        return response()->json([
            'success' => true,
            'status' => $program->status,
            'message' => 'Program status updated.'
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:programs,id',
        ]);

        foreach ($request->order as $index => $id) {
            \App\Models\Program::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true, 'message' => 'Order updated.']);
    }

    public function duplicate(Program $program)
    {
        $newProgram = $program->replicate();
        $newProgram->title = $program->title . ' (Copy)';
        $newProgram->slug = \Illuminate\Support\Str::slug($newProgram->title);
        $newProgram->status = false; // Default to inactive
        $newProgram->order = \App\Models\Program::max('order') + 1;
        $newProgram->push(); // Save the new model and its relations (if we had any loaded, but here replicate clones attributes)

        return redirect()->route('admin.programs.index')->with('success', 'Program duplicated successfully.');
    }
}
