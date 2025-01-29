<?php

namespace App\Services;

use App\Models\Supplier;
use Illuminate\Support\Collection;

interface SupplierServiceInterface
{
    public function getAllSuppliers($search): Collection;
    public function getSupplierById($id): Supplier;
    public function createSupplier(array $data): Supplier;
    public function updateSupplier($id, array $data): Supplier;
    public function deleteSupplier($id): bool;
}