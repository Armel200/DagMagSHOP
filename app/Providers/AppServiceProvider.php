<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

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
    try {
        if (Schema::hasTable('categories')) {
            // Ton code ici seulement si la table existe
        }
    } catch (\Exception $e) {
        // Ignore les erreurs au build
    }
}
}
