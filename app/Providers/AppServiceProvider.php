<?php

namespace App\Providers;

use App\Models\CompanyProfile;
use App\Models\Solution;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('company_profiles')) {
            $companyProfile = CompanyProfile::first();
            View::share('companyProfile', $companyProfile);
        }

        Route::bind('category', function (string $value) {
            if (!array_key_exists($value, Solution::$categorySlugMap)) {
                abort(404);
            }
            return Solution::$categorySlugMap[$value];
        });
    }
}
