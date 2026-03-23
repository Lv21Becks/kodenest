<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Application;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Invoice;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ─── ZONE 1: KEY METRICS ─────────────────────────────────────────
        $pendingApplications = Application::where('status', 'pending')->count();
        $activeStudents      = Enrollment::where('status', Enrollment::STATUS_ACTIVE)->count();
        $pendingPayments     = Invoice::whereIn('status', ['unpaid', 'partial'])->count();
        $certificatesReady   = 0; // Placeholder — certificates model not yet live
        $totalPrograms       = Program::where('status', true)->count();

        // ─── ZONE 2A: NEEDS ATTENTION ────────────────────────────────────
        // Latest 5 pending applications
        $pendingApplicationsList = Application::with('applicant')->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // Invoices with outstanding balance
        $pendingInvoicesList = Invoice::whereIn('status', ['unpaid', 'partial'])
            ->latest()
            ->take(5)
            ->get();

        // ─── ZONE 2B: RECENT ACTIVITY ────────────────────────────────────
        $recentEnrollments = Enrollment::with('student', 'program')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($e) => (object)[
                'icon'        => 'fas fa-user-graduate',
                'color'       => 'bg-green-100 text-green-600',
                'title'       => ($e->student->first_name ?? '') . ' ' . ($e->student->last_name ?? ''),
                'description' => 'enrolled in ' . ($e->program->title ?? $e->program_id),
                'time'        => $e->created_at,
                'url'         => route('admin.students.index'),
            ]);

        $recentApplications = Application::with('applicant')
            ->where('status', 'approved')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($a) => (object)[
                'icon'        => 'fas fa-check-circle',
                'color'       => 'bg-blue-100 text-blue-600',
                'title'       => ($a->applicant->first_name ?? '') . ' ' . ($a->applicant->last_name ?? ''),
                'description' => 'application approved',
                'time'        => $a->updated_at,
                'url'         => route('admin.applications.index'),
            ]);

        $recentBlogPosts = BlogPost::latest()->take(3)->get()
            ->map(fn($p) => (object)[
                'icon'        => 'fas fa-blog',
                'color'       => 'bg-purple-100 text-purple-600',
                'title'       => \Str::limit($p->title, 35),
                'description' => 'blog post published',
                'time'        => $p->created_at,
                'url'         => route('admin.blog-posts.index'),
            ]);

        $recentActivity = $recentEnrollments
            ->concat($recentApplications)
            ->concat($recentBlogPosts)
            ->sortByDesc('time')
            ->take(8);

        // ─── ZONE 3: TRENDS (last 7 days) ────────────────────────────────
        $appTrend = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            return [
                'label' => $date->format('D'),
                'count' => Application::whereDate('created_at', $date)->count(),
            ];
        });

        $paymentTrend = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            return [
                'label' => $date->format('D'),
                'count' => Invoice::whereDate('created_at', $date)->count(),
            ];
        });

        $appTrendMax     = $appTrend->max('count') ?: 1;
        $paymentTrendMax = $paymentTrend->max('count') ?: 1;

        return view('admin.dashboard', compact(
            'pendingApplications',
            'activeStudents',
            'pendingPayments',
            'certificatesReady',
            'totalPrograms',
            'pendingApplicationsList',
            'pendingInvoicesList',
            'recentActivity',
            'appTrend',
            'paymentTrend',
            'appTrendMax',
            'paymentTrendMax'
        ));
    }
}
