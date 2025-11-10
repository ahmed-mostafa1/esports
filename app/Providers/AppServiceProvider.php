<?php

namespace App\Providers;

use App\Models\SiteVisit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.app', function ($view): void {
            $totalVisitors = Cache::remember(
                'site_visits_total',
                now()->addMinutes(10),
                static fn () => SiteVisit::count()
            );

            $view->with('totalVisitorCount', $totalVisitors);
        });
    }
}
