<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Session;
use View;

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
        view()->composer('*', function($view)
        {
            $view
                ->with('branches', Branch::where('branch_status_id', 1)->orderBy('branch_code', 'desc')->get())
                ->with('courses', Course::where('course_status_id', 1)->orderBy('course_name', 'asc')->get())
                ->with('sessions', Session::where('session_status_id', 1)->orderBy('session_name', 'asc')->get());
        });
    }
}
