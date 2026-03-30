<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Password;
use App\Models\Program;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Strong password policy: min 8 chars, 1 uppercase, 1 number, 1 symbol
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        View::composer('components.public-navbar', function ($view) {
            $view->with('navbarPrograms', Program::active()->get(['title', 'slug']));
        });

        View::composer('layouts.admin', function ($view) {
            $pendingApplicationsList = \App\Models\Application::with('applicant')->where('status', 'pending')->orderBy('created_at', 'desc')->take(3)->get();
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

