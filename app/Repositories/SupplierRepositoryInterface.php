<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\Supplier;

interface SupplierRepositoryInterface
{
    public function getAllSuppliers(): Collection;
    public function searchSuppliersByName($name): Collection;
    public function getSupplierById($id): Supplier;
    public function createSupplier(array $data): Supplier;
    public function updateSupplier($id, array $data): Supplier;
    public function deleteSupplier($id): bool;
}