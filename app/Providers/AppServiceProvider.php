<?php

namespace App\Providers;

use App\Services\Github\GithubLogin;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->bind('Github', GithubLogin::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('lmp', function($x) { 
            return strlen($x);
        });
    }
}
