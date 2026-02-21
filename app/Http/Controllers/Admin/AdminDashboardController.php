<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\BlogPost;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Stats Calculation
        // Revenue: Sum of prices of programs for all ACTIVE/GRADUATED students (assuming 'paid' status or just enrolled)
        // For accurate revenue, we should check payment_status 'paid' or 'partial'. For now, simplified to all enrolled.
        // We need to match student program slugs to program prices.
        $programsMap = Program::all()->pluck('price', 'slug');
        $students = \App\Models\Student::all();

        $totalRevenue = 0;
        foreach ($students as $student) {
            // Handle slug mismatch (software-dev vs software-development)
            $slug = $student->program;
            if ($slug === 'software-development')
                $slug = 'software-dev'; // legacy fix

            if (isset($programsMap[$slug])) {
                $totalRevenue += $programsMap[$slug];
            }
        }

        $stats = [
            'total_subscribers' => \App\Models\NewsletterSubscriber::count(),
            'active_students' => \App\Models\Student::where('status', 'active')->count(),
            'revenue' => $totalRevenue,
            'pending_enrollments' => \App\Models\Student::where('status', 'pending')->count(),
            'avg_rating' => \App\Models\Testimonial::avg('rating') ?? 5.0,
            'active_programs' => Program::where('status', true)->count(),
            'pending_testimonials' => Testimonial::where('status', false)->count(),
        ];

        // 2. Recent Activity - Merge Subscribers, Testimonials, AND Students
        $recentSubscribers = \App\Models\NewsletterSubscriber::latest()
            ->take(5)->get()->map(function ($item) {
                return (object) [
                    'type' => 'subscriber',
                    'icon' => 'fas fa-envelope',
                    'title' => 'New Subscriber',
                    'description' => $item->email,
                    'time' => $item->created_at,
                    'action_url' => route('admin.newsletter.index'),
                ];
            });

        $recentTestimonials = Testimonial::latest()
            ->take(5)->get()->map(function ($item) {
                return (object) [
                    'type' => 'testimonial',
                    'icon' => 'fas fa-star',
                    'title' => 'New Testimonial',
                    'description' => $item->name,
                    'time' => $item->created_at,
                    'action_url' => route('admin.testimonials.index'),
                ];
            });

        $recentStudents = \App\Models\Student::latest()
            ->take(5)->get()->map(function ($item) {
                return (object) [
                    'type' => 'student',
                    'icon' => 'fas fa-user-graduate',
                    'title' => 'New Enrollment',
                    'description' => $item->first_name . ' ' . $item->last_name,
                    'time' => $item->created_at,
                    'action_url' => route('admin.students.index'),
                ];
            });

        // Merge and sort
        $recentActivity = $recentSubscribers
            ->concat($recentTestimonials)
            ->concat($recentStudents)
            ->sortByDesc('time')
            ->take(10);

        // 3. Programs for Performance Widget
        $programs = Program::where('status', true)->orderBy('order')->get()->map(function ($program) {
            $slug = $program->slug;
            if ($slug === 'software-development')
                $slug = 'software-dev';

            $count = \App\Models\Student::where('program', $slug)->count();
            $program->student_count = $count;
            $program->revenue = $count * $program->price;
            return $program;
        });

        // 4. Action Items (Dynamic "Requires Attention")
        $actionItems = [];

        // Pending Enrollments
        if ($stats['pending_enrollments'] > 0) {
            $actionItems[] = [
                'color' => 'red',
                'dot_color' => 'bg-red-500',
                'text' => $stats['pending_enrollments'] . ' enrollment request' . ($stats['pending_enrollments'] > 1 ? 's' : '') . ' waiting approval',
                'btn_text' => 'Review Now',
                'btn_url' => route('admin.enrollments.index', ['status' => 'pending']),
                'btn_class' => 'bg-red-600 text-white hover:bg-red-700'
            ];
        }

        // Payment Due (Pending or Defaulting)
        // Check for 'pending' or 'due' payment status
        $paymentDueCount = \App\Models\Student::whereIn('payment_status', ['pending', 'due'])->count();
        if ($paymentDueCount > 0) {
            $actionItems[] = [
                'color' => 'yellow',
                'dot_color' => 'bg-yellow-500',
                'text' => $paymentDueCount . ' student' . ($paymentDueCount > 1 ? 's' : '') . ' with pending payments',
                'btn_text' => 'View List',
                'btn_url' => route('admin.enrollments.index', ['status' => 'payment_due']),
                'btn_class' => 'bg-yellow-600 text-white hover:bg-yellow-700'
            ];
        }

        // SEO Meta Missing for Programs
        $programsWithSeo = \App\Models\SeoMeta::where('route_name', 'programs.show')->whereNotNull('item_id')->pluck('item_id')->toArray();
        $programsWithoutSeo = \App\Models\Program::whereNotIn('id', $programsWithSeo)->count();

        if ($programsWithoutSeo > 0) {
            $actionItems[] = [
                'color' => 'orange',
                'dot_color' => 'bg-orange-500',
                'text' => $programsWithoutSeo . ' program' . ($programsWithoutSeo > 1 ? 's' : '') . ' missing SEO configuration',
                'btn_text' => 'Fix SEO',
                'btn_url' => route('admin.seo-meta.index'),
                'btn_class' => 'bg-orange-600 text-white hover:bg-orange-700'
            ];
        }

        return view('admin.dashboard', compact('stats', 'recentActivity', 'programs', 'actionItems'));
    }
}
