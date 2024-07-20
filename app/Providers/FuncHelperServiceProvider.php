<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FuncHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path() . '/Helper/FuncHelper.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
