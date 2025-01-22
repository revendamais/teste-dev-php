<?php

declare(strict_types=1);

namespace App\BrasilApi\Providers;

use App\BrasilApi\Services\API\BrasilApi;
use App\BrasilApi\Services\API\BrasilApiInterface;
use Illuminate\Support\ServiceProvider;

class BrasilApiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BrasilApiInterface::class, BrasilApi::class);
    }
}