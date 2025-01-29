<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function getAllSuppliers(): Collection
    {
        return Supplier::with('address')->get();
    }

    public function searchSuppliersByName($name): Collection
    {
        return Supplier::where('name', 'like', '%' . $name . '%')->get();
    }

    public function getSupplierById($id): Supplier
    {
        return Supplier::with('address')->findOrFail($id);
    }

    public function createSupplier(array $data): Supplier
    {
        $supplier = Supplier::create($data);

        if (isset($data['address'])) {
            $supplier->address()->create($data['address']);
        }

        return $supplier;
    }

    public function updateSupplier($id, array $data): Supplier
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);

        if (isset($data['address'])) {
            $supplier->address()->update($data['address']);
        }
        
        return $supplier;
    }

    public function deleteSupplier($id): bool
    {
        $supplier = Supplier::findOrFail($id);
        return $supplier->delete();
    }
}