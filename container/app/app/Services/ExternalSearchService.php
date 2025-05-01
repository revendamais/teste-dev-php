<?php

namespace App\Services;

use App\Helpers\Cacher;
use App\Services\Contracts\ExternalSearchServiceInterface;
use RafaelLaurindo\BrasilApi\BrasilApiFacade;
use LaravelLegends\PtBrValidator\Rules\Cnpj;

class ExternalSearchService implements ExternalSearchServiceInterface
{
    private $cacher;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->cacher = new Cacher('redis');
    }

    public function searchCNPJ($cnpj)
    {
        $validator = new Cnpj($cnpj);
        if ($validator) {
            $cachedData = $this->cacher->getCached('search_'.$cnpj);
            if ($cachedData) {
                $data = $cachedData;
            } else {
                $data = BrasilApiFacade::findCnpj($cnpj);
                $this->cacher->setCached('search_'.$cnpj, json_encode($data));
            }
            return $data;
        }
    }
}
