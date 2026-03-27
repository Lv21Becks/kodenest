<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Program;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.public-navbar', function ($view) {
            $view->with('navbarPrograms', Program::active()->get(['title', 'slug']));
        });

        View::composer('layouts.admin', function ($view) {
            $pendingApplicationsList = \App\Models\Application::with('program')->where('status', 'pending')->orderBy('created_at', 'desc')->take(3)->get();
            $pendingPaymentsList = \App\Models\Payment::with('student')->where('status', 'pending')->orderBy('created_at', 'desc')->take(3)->get();
            
            $pendingApplications = \App\Models\Application::where('status', 'pending')->count();
            $pendingPayments = \App\Models\Payment::where('status', 'pending')->count();
            
            $totalNotificationsCount = $pendingApplications + $pendingPayments;

            $view->with(compact(
                'pendingApplicationsList',
                'pendingPaymentsList',
                'pendingApplications',
                'pendingPayments',
                'totalNotificationsCount'
            ));
        });
    }
}
