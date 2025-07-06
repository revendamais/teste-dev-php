<?php

namespace danielbastos\revendamais;

use Illuminate\Support\ServiceProvider;
use danielbastos\revendamais\Repositories\Interfaces\SupplierRepositoryInterface;
use danielbastos\revendamais\Repositories\SupplierRepository;

class RevendaMaisServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/revendamais.php', 'revendamais');
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config/revendamais.php' => config_path('revendamais.php')], 'revendamais'); 
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }
}
