<?php

declare(strict_types=1);

namespace App\Suppliers\Providers;

use App\Suppliers\Interfaces\SuppliersRepositoryInterface;
use App\Suppliers\Repositories\SuppliersRepository;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SuppliersRepositoryInterface::class, SuppliersRepository::class);
    }
}