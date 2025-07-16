<?php
namespace App\Services\Facades;

use App\Services\ApiExternos\BuscaCnpj;
use Illuminate\Support\Facades\Facade;


class ServiceBuscaCnpj extends Facade
{

    protected static function getFacadeAccessor()
    {
        return BuscaCnpj::class;
    }
}