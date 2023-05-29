<?php

namespace Devpac\Dashboard;

use Illuminate\Support\ServiceProvider;
use Devpac\Dashboard\Services\Dashboard;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->bind('Dashboard', function () {
        //     return new Dashboard();
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/dashboard.php' => config_path('dashboard.php'),
        ], 'dashboard-config');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'dashboard');
    }
}
