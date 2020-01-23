<?php

namespace App\Providers;

use App\NullUser;
use App\User;
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
        view()->share('signedIn', auth()->check());
        view()->share('authUser', auth()->user() ?: new NullUser());
    }
}
