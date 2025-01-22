<?php

declare(strict_types=1);

namespace App\BrasilApi\Services\API;

interface BrasilApiInterface
{
    public function getCnpj(string $cnpj): array;
}