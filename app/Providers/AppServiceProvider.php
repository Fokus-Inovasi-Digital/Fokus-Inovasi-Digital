<?php

namespace App\Providers;

use App\Models\CompanyProfile;
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

        // View::composer('*', \App\View\Composers\CompanyProfileComposer::class);
    }
}
