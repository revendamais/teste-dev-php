<?php

namespace App\Services\Suppliers;

use App\DTO\Suppliers\CreateDTO;
use App\DTO\Suppliers\UpdateDTO;
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

    public function show(int $id): array
    {
        return $this->repository->show($id);
    }

    public function create(CreateDTO $dto): array
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateDTO $dto, int $id): array
    {
        return $this->repository->update($dto, $id);
    }

    public function destroy(int $id): array
    {
        return $this->repository->destroy($id);
    }
}
