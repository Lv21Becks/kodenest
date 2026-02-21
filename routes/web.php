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
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('programs/{program}/toggle-status', [AdminProgramController::class, 'toggleStatus'])->name('programs.toggle-status');
    Route::post('programs/reorder', [AdminProgramController::class, 'reorder'])->name('programs.reorder');
    Route::post('programs/{program}/duplicate', [AdminProgramController::class, 'duplicate'])->name('programs.duplicate');
    Route::resource('programs', AdminProgramController::class);

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
    Route::resource('features', \App\Http\Controllers\Admin\FeatureController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('seo-meta', SeoMetaController::class);
    Route::resource('newsletter', \App\Http\Controllers\Admin\NewsletterController::class)->only(['index', 'destroy']);
    Route::resource('students', \App\Http\Controllers\Admin\AdminStudentController::class);
});

require __DIR__ . '/auth.php';

