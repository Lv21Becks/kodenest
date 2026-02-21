<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class SeoMetaController extends Controller
{
    public function index()
    {
        $staticPages = ['home', 'about', 'programs', 'testimonials', 'blog', 'contact', 'enroll'];

        $programs = \App\Models\Program::active()->get();
        $blogPosts = \App\Models\BlogPost::published()->get();

        // Key by 'page' for easy lookup (e.g. 'home', 'program:1', 'blog:5')
        $seoMeta = SeoMeta::all()->keyBy('page');

        return view('admin.seo-meta.index', compact('seoMeta', 'staticPages', 'programs', 'blogPosts'));
    }

    public function create(Request $request)
    {
        $page = $request->query('page'); // Optional if creating via static list
        $itemId = $request->query('item_id');
        $routeName = $request->query('route_name');

        // Base defaults
        $defaults = [
            'title' => 'KodeNest Academy',
            'description' => 'Welcome to KodeNest ICT Academy.',
            'og_image' => asset('images/logo.png'),
            'keywords' => 'coding, academy, nigeria'
        ];

        // Dynamic Logic (e.g. Coming from Program Hub)
        if ($routeName === 'programs.show' && $itemId) {
            $program = \App\Models\Program::find($itemId);
            if ($program) {
                // Generate a unique 'page' identifier for the DB constraint
                // Format: program:{slug}
                if (!$page)
                    $page = 'program:' . $program->slug;

                $defaults['title'] = $program->title . ' | KodeNest Academy';
                $defaults['description'] = \Illuminate\Support\Str::limit(strip_tags($program->description), 160);
                $defaults['og_image'] = $program->image_icon ? asset('storage/' . $program->image_icon) : null;
                $defaults['keywords'] = implode(', ', $program->skills ?? []);
            }
        } elseif (\Illuminate\Support\Str::startsWith($page, 'program:')) {
            // ... Legacy/Direct logic if needed, or just merge
        }

        // Static Page Defaults (Fallback if no dynamic params)
        if (!$itemId && $page) {
            $defaults['title'] = ucfirst($page) . ' - KodeNest';
            // ... existing switch case ...
            switch ($page) {
                case 'home':
                    $defaults['title'] = 'KodeNest - Best Coding Academy in Nigeria';
                    $defaults['description'] = 'Master in-demand tech skills at KodeNest. Join our hands-on coding bootcamps in Web Development, Data Science, and more.';
                    break;
                case 'about':
                    $defaults['title'] = 'About Us - Empowering Tech Talent';
                    $defaults['description'] = 'Learn about KodeNest\'s mission to bridge the digital skills gap and empower the next generation of African tech leaders.';
                    break;
                case 'programs':
                    $defaults['title'] = 'Our Programs - Launch Your Tech Career';
                    $defaults['description'] = 'Explore our comprehensive courses in Software Engineering, Data Analysis, Product Design, and more. Start your journey today.';
                    break;
                case 'testimonials':
                    $defaults['title'] = 'Student Success Stories | KodeNest';
                    $defaults['description'] = 'See what our graduates are achieving. Read real stories of career transformation from KodeNest alumni.';
                    break;
                case 'contact':
                    $defaults['title'] = 'Contact Us | KodeNest';
                    $defaults['description'] = 'Get in touch with our admissions team. Have questions? We are here to help you start your tech career.';
                    break;
                case 'enroll':
                    $defaults['title'] = 'Enroll Now - Start Learning Today';
                    $defaults['description'] = 'Secure your spot in our next cohort. Easy application process for all our coding bootcamps.';
                    break;
            }
        }

        return view('admin.seo-meta.create', compact('page', 'defaults', 'itemId', 'routeName'));
    }

    public function edit(SeoMeta $seoMetum)
    {
        return view('admin.seo-meta.edit', compact('seoMetum'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|unique:seo_meta,page',
            'item_id' => 'nullable|string',
            'route_name' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'nullable|string',
            'og_image' => 'nullable|string',
        ]);

        SeoMeta::create($validated);

        // Redirect logic: if created from Program Hub, go back to Program Edit?
        // Ideally checking "referer" or passing a "redirect_to". 
        // For now, default index.
        return redirect()->route('admin.seo-meta.index')->with('success', 'SEO meta created successfully!');
    }

    public function update(Request $request, SeoMeta $seoMetum)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'nullable|string',
            'og_image' => 'nullable|string',
        ]);

        $seoMetum->update($validated);

        return redirect()->route('admin.seo-meta.index')->with('success', 'SEO meta updated successfully!');
    }
}
