<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        $stats = [
            'total' => Testimonial::count(),
            'approved' => Testimonial::where('status', true)->count(),
            'pending' => Testimonial::where('status', false)->count(),
            'avg_rating' => number_format(Testimonial::avg('rating') ?? 0, 1),
        ];

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->status == 'approved' ? 1 : 0;
            $query->where('status', $status);
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        $testimonials = $query->orderByDesc('created_at')->paginate(9)->withQueryString();

        return view('admin.testimonials.index', compact('testimonials', 'stats'));
    }

    public function toggleStatus(Testimonial $testimonial)
    {
        $testimonial->status = !$testimonial->status;
        $testimonial->save();
        return response()->json(['success' => true, 'status' => $testimonial->status]);
    }

    public function bulkApprove(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        Testimonial::whereIn('id', $request->ids)->update(['status' => true]);
        return back()->with('success', 'Selected testimonials approved.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        $testimonials = Testimonial::whereIn('id', $request->ids)->get();
        foreach ($testimonials as $t) {
            if ($t->image) {
                Storage::disk('public')->delete($t->image);
            }
        }
        Testimonial::whereIn('id', $request->ids)->delete();
        return back()->with('success', 'Selected testimonials deleted.');
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'featured' => 'boolean',
            'status' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $validated['featured'] = $request->has('featured');
        $validated['status'] = true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        } else {
            unset($validated['image']);
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_image' => 'nullable|boolean',
            'featured' => 'boolean',
            'status' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $validated['featured'] = $request->has('featured');
        $validated['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        } elseif ($request->boolean('remove_image')) {
            // Admin explicitly removed the image
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $validated['image'] = null;
        } else {
            // Keep existing image
            unset($validated['image']);
        }

        unset($validated['remove_image']);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}
