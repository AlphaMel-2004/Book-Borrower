<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        // Temporarily comment out to debug the issue
        // Blade::component('admin-layout', \App\View\Components\AdminLayout::class);
        Blade::component('app-layout', \App\View\Components\AppLayout::class);
    }
}
