<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator; // Import class Paginator
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Gunakan Bootstrap untuk pagination
        Paginator::useBootstrap();
    }
}
