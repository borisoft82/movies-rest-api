<?php

namespace App\Providers;

use App\Models\MovieUser;
use App\Observers\MovieUserObserver;
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
        MovieUser::observe(MovieUserObserver::class);
    }
}
