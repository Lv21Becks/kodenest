<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Program;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        $programs = Program::active()->take(3)->get();
        $testimonials = Testimonial::active()->take(3)->get();
        $posts = BlogPost::published()->latest()->take(3)->get();

        $features = \App\Models\Feature::active()->get();

        $seo = \App\Models\SeoMeta::getForPage('home');

        return view('welcome', compact('programs', 'testimonials', 'posts', 'features', 'seo'));
    }

    public function about()
    {
        $seo = \App\Models\SeoMeta::getForPage('about');
        return view('about', compact('seo'));
    }

    public function programs()
    {
        $programs = Program::active()->get();
        $seo = \App\Models\SeoMeta::getForPage('programs');
        return view('programs', compact('programs', 'seo'));
    }

    public function program($slug)
    {
        $program = Program::active()->where('slug', $slug)->firstOrFail();

        // Check for SEO Override
        $seoOverride = \App\Models\SeoMeta::where('page', 'program:' . $program->id)->first();

        // Dynamic SEO (Fallback)
        $seo = $seoOverride ?? new \App\Models\SeoMeta([
            'title' => $program->title . ' - KodeNest',
            'description' => Str::limit($program->description, 160),
            'image' => $program->image_icon ? asset('storage/' . $program->image_icon) : null,
        ]);

        return view('program-details', compact('program', 'seo'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::active()->get();
        $seo = \App\Models\SeoMeta::getForPage('testimonials');
        return view('testimonials', compact('testimonials', 'seo'));
    }

    public function blog()
    {
        $posts = BlogPost::published()->latest()->get();
        $seo = \App\Models\SeoMeta::getForPage('blog');
        return view('blog', compact('posts', 'seo'));
    }

    public function blogPost($slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();

        // Check for SEO Override
        $seoOverride = \App\Models\SeoMeta::where('page', 'blog:' . $post->id)->first();

        // Construct dynamic SEO for the post (Fallback)
        $seo = $seoOverride ?? new \App\Models\SeoMeta([
            'title' => $post->title . ' - KodeNest Blog',
            'description' => $post->excerpt ?? Str::limit(strip_tags($post->content), 160),
            'image' => $post->featured_image,
            'keywords' => $post->category ?? 'tech, coding, education'
        ]);

        return view('blog-post', compact('post', 'seo'));
    }

    public function contact()
    {
        $programs = Program::active()->get();
        $seo = \App\Models\SeoMeta::getForPage('contact');
        return view('contact', compact('programs', 'seo'));
    }

    public function enroll()
    {
        $programs = Program::active()->get();
        $seo = \App\Models\SeoMeta::getForPage('enroll');
        return view('enroll', compact('programs', 'seo'));
    }
}
