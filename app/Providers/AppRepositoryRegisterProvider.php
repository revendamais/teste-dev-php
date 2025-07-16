<?php

namespace App\Providers;

use App\Main\Fornecedor\Repository\FornecedorRepository;
use App\Main\Fornecedor\Repository\FornecedorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppRepositoryRegisterProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FornecedorRepositoryInterface::class, FornecedorRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
