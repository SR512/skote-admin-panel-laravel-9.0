<?php

namespace App\Providers;

use App\Repositories\CommonRepository;
use App\Repositories\EyeReviewDocumentsRepository;
use App\Repositories\EyeReviewDetailsRepository;
use App\Repositories\EyeReviewRepository;
use App\Repositories\PatientDetailsRepository;
use App\Repositories\RoleRepository;
use App\Repositories\StentRegistryRepository;
use App\Repositories\TrustRepository;
use App\Repositories\UserRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton('role-repo', RoleRepository::class);
        $this->app->singleton('user-repo', UserRepository::class);
        $this->app->singleton('common-repo', CommonRepository::class);
    }
}
