<?php

namespace App\Repositories\Suppliers;

use App\DTO\Suppliers\CreateDTO;
use App\DTO\Suppliers\UpdateDTO;

interface SupplierRepositoryInterface
{
    public function all(): array;
    public function create(CreateDTO $dto): array;
    public function update(UpdateDTO $dto, int $id): array;
}
