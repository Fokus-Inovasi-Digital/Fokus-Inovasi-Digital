<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Career;
use App\Models\Solution;
use Illuminate\Support\Facades\Route;
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
        Route::bind('article', fn($value) => Article::where('slug', $value)->firstOrFail());
        Route::bind('solution', fn($value) => Solution::where('slug', $value)->firstOrFail());
        Route::bind('career', fn($value) => Career::where('slug', $value)->firstOrFail());
    }
}
