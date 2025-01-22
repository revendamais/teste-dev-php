<?php

declare(strict_types=1);

namespace App\BrasilApi\Services;

use App\BrasilApi\Services\API\BrasilApiInterface;

class BrasilApiService
{
    public function __construct(
        private BrasilApiInterface $brasilApi,
    )
    {
    }

    public function getCnpjSupplier(string $cnpj): array
    {
        $response = $this->brasilApi->getCnpj($cnpj);

        if (array_key_exists('error', $response)) {
            return [];
        }

        $response = $response['success'];

        return [
            $response
        ];
    }
}