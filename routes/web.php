<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SeoMetaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

// Public routes
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/programs', 'programs')->name('programs');
    Route::get('/programs/{slug}', 'program')->name('programs.show');
    Route::get('/testimonials', 'testimonials')->name('testimonials');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{slug}', 'blogPost')->name('blog.show');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/enroll', 'enroll')->name('enroll');
    Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
});

Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/contact/send', [\App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Breeze default dashboard (redirect admins to admin dashboard)
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes (protected by auth and admin middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Redirect base /admin to dashboard (which will then redirect to login if unauthenticated)
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Admin Guest Routes (Login + Password Reset)
    Route::middleware('guest')->group(function () {
        Route::get('login', [\App\Http\Controllers\Admin\AdminLoginController::class, 'create'])->name('login');
        Route::post('login', [\App\Http\Controllers\Admin\AdminLoginController::class, 'store']);
        Route::get('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('forgot-password');
        Route::post('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Auth\NewPasswordController::class, 'store'])->name('password.store');
    });

    // Admin 2FA Routes (Require auth and admin role, but MUST NOT require 2fa verified session)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('2fa', [\App\Http\Controllers\Admin\TwoFactorController::class, 'index'])->name('2fa.index');
        Route::post('2fa', [\App\Http\Controllers\Admin\TwoFactorController::class, 'store'])->name('2fa.store');
        Route::post('2fa/resend', [\App\Http\Controllers\Admin\TwoFactorController::class, 'resend'])->name('2fa.resend');
    });

    // Admin Authenticated Routes (Fully guarded)
    Route::middleware(['auth', 'admin', '2fa'])->group(function () {
        
        // Settings Restricted to Super Admin Only
        Route::middleware(['role:' . \App\Models\User::ROLE_SUPER_ADMIN])->group(function () {
            Route::get('settings', [\App\Http\Controllers\Admin\AdminSettingController::class, 'index'])->name('settings.index');
            Route::post('settings', [\App\Http\Controllers\Admin\AdminSettingController::class, 'update'])->name('settings.update');
        });
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('programs/{program}/toggle-status', [AdminProgramController::class, 'toggleStatus'])->name('programs.toggle-status');
    Route::post('programs/reorder', [AdminProgramController::class, 'reorder'])->name('programs.reorder');
    Route::post('programs/{program}/duplicate', [AdminProgramController::class, 'duplicate'])->name('programs.duplicate');
    Route::resource('programs', AdminProgramController::class);

    // Admissions (Applicants & Applications)
    Route::get('applicants', [\App\Http\Controllers\Admin\ApplicantController::class, 'index'])->name('applicants.index');
    Route::get('applicants/{applicant}', [\App\Http\Controllers\Admin\ApplicantController::class, 'show'])->name('applicants.show');
    
    Route::post('applications/bulk-approve', [\App\Http\Controllers\Admin\AdminApplicationController::class, 'bulkApprove'])->name('applications.bulk-approve');
    Route::post('applications/bulk-reject', [\App\Http\Controllers\Admin\AdminApplicationController::class, 'bulkReject'])->name('applications.bulk-reject');
    Route::post('applications/{application}/approve', [\App\Http\Controllers\Admin\AdminApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('applications/{application}/reject', [\App\Http\Controllers\Admin\AdminApplicationController::class, 'reject'])->name('applications.reject');
    Route::resource('applications', \App\Http\Controllers\Admin\AdminApplicationController::class);

    // Enrollments
    Route::post('enrollments/bulk-approve', [\App\Http\Controllers\Admin\AdminEnrollmentController::class, 'bulkApprove'])->name('enrollments.bulk-approve');
    Route::post('enrollments/bulk-reject', [\App\Http\Controllers\Admin\AdminEnrollmentController::class, 'bulkReject'])->name('enrollments.bulk-reject');
    Route::post('enrollments/{student}/approve', [\App\Http\Controllers\Admin\AdminEnrollmentController::class, 'approve'])->name('enrollments.approve');
    Route::post('enrollments/{student}/reject', [\App\Http\Controllers\Admin\AdminEnrollmentController::class, 'reject'])->name('enrollments.reject');
    Route::resource('enrollments', \App\Http\Controllers\Admin\AdminEnrollmentController::class);

    // Testimonials
    Route::post('testimonials/bulk-approve', [AdminTestimonialController::class, 'bulkApprove'])->name('testimonials.bulk-approve');
    Route::post('testimonials/bulk-delete', [AdminTestimonialController::class, 'bulkDelete'])->name('testimonials.bulk-delete');
    Route::post('testimonials/{testimonial}/toggle-status', [AdminTestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');
    Route::resource('testimonials', AdminTestimonialController::class);
    Route::resource('blog-posts', AdminBlogPostController::class);
    // ==========================================
    // ROLE: RESTRICTED TO SUPER ADMIN & ADMIN
    // ==========================================
    Route::middleware('role:super_admin,admin')->group(function () {
        // Payments
        Route::post('payments/{payment}/verify', [\App\Http\Controllers\Admin\AdminPaymentController::class, 'verify'])->name('payments.verify');
        Route::resource('payments', \App\Http\Controllers\Admin\AdminPaymentController::class);
        Route::view('payments/approvals', 'admin.payments.index')->name('payments.approvals_placeholder');
        Route::view('payments/settings', 'admin.payments.index')->name('payments.settings_placeholder');
        
        // Analytics
        Route::get('analytics', [\App\Http\Controllers\Admin\AdminAnalyticsController::class, 'index'])->name('analytics.index');
        Route::view('analytics/student', 'admin.analytics.index')->name('analytics.student_placeholder');
        Route::view('analytics/revenue', 'admin.analytics.index')->name('analytics.revenue_placeholder');
        
        // System (Admin Users & Roles)
        Route::resource('system-users', \App\Http\Controllers\Admin\AdminSystemController::class);
        Route::view('system-users/roles', 'admin.system-users.index')->name('system-users.roles_placeholder');
    });

    // ==========================================
    // ROLE: STRICTLY SUPER ADMIN
    // ==========================================
    Route::middleware('role:super_admin')->group(function () {
        Route::resource('features', \App\Http\Controllers\Admin\FeatureController::class);
        Route::resource('seo-meta', SeoMetaController::class);
        Route::resource('newsletter', \App\Http\Controllers\Admin\NewsletterController::class)->only(['index', 'destroy']);
        Route::view('newsletter/campaigns', 'admin.newsletter.index')->name('newsletter.campaigns_placeholder');
    });

    // Testimonials
    Route::post('testimonials/{testimonial}/toggle-status', [\App\Http\Controllers\Admin\TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);

    // Certificates
    Route::resource('certificates', \App\Http\Controllers\Admin\AdminCertificateController::class);
    Route::view('certificates/verification', 'admin.certificates.index')->name('certificates.verification_placeholder');

    Route::resource('students', \App\Http\Controllers\Admin\AdminStudentController::class);
    Route::get('alumni', [\App\Http\Controllers\Admin\AdminEnrollmentController::class, 'index'])->name('alumni.index');
    Route::view('students/progress', 'admin.students.index')->name('students.progress_placeholder');
    Route::view('programs/lessons', 'admin.programs.index')->name('programs.lessons_placeholder');

    // Contact Messages
    Route::get('contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{contactMessage}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::delete('contact-messages/{contactMessage}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    Route::post('contact-messages/mark-all-read', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAllRead'])->name('contact-messages.mark-all-read');
}); // Close the inner auth/admin middleware group
}); // Close the outer admin prefix group

require __DIR__ . '/auth.php';

