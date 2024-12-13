<?php

namespace App\Services\Suppliers;

use App\DTO\Suppliers\CreateDTO;
use App\Models\Supplier;
use App\Repositories\Suppliers\SupplierRepositoryInterface;

class SupplierService
{
    public function __construct(protected SupplierRepositoryInterface $repository)
    {}

    public function all(): array
    {
        return $this->repository->all();
    }

    public function create(CreateDTO $dto): array
    {
        return $this->repository->create($dto);
    }
}
