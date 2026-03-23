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
            $view->with('pendingEnrollmentsCount', \App\Models\Application::where('status', 'pending')->count());
        });
    }
}
