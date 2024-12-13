<?php

namespace App\Repositories\Suppliers;

use App\DTO\Suppliers\CreateDTO;

interface SupplierRepositoryInterface
{
    public function all(): array;
    public function create(CreateDTO $dto): array;
}
