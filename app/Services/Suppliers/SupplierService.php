<?php

namespace App\Services\Suppliers;

use App\Repositories\Suppliers\SupplierRepositoryInterface;

class SupplierService
{
    public function __construct(Protected SupplierRepositoryInterface $repository)
    {}

    public function all(): array
    {
        return $this->repository->all();
    }
}
