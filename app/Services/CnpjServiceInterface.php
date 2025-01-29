<?php

namespace App\Services;

interface CnpjServiceInterface
{
    public function getCnpjData(string $cnpj): array;
}