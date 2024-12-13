<?php

namespace App\Repositories\Suppliers;

use App\DTO\Suppliers\CreateDTO;
use App\DTO\Suppliers\UpdateDTO;
use Illuminate\Http\Request;

interface SupplierRepositoryInterface
{
    public function all(Request $request): array;
    public function show(int $id): array;
    public function create(CreateDTO $dto): array;
    public function update(UpdateDTO $dto, int $id): array;
    public function destroy(int $id): array;
}
