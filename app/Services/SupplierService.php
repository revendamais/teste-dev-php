<?php

namespace App\Services;

use App\Models\Supplier;
use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Support\Collection;

class SupplierService implements SupplierServiceInterface
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllSuppliers($search): Collection
    {
        if ($search) {
            return $this->supplierRepository->searchSuppliersByName($search);
        }
        
        return $this->supplierRepository->getAllSuppliers();
    }

    public function getSupplierById($id): Supplier
    {
        return $this->supplierRepository->getSupplierById($id);
    }

    public function createSupplier(array $data): Supplier
    {
        return $this->supplierRepository->createSupplier($data);
    }

    public function updateSupplier($id, array $data): Supplier
    {
        return $this->supplierRepository->updateSupplier($id, $data);
    }

    public function deleteSupplier($id): bool
    {
        return $this->supplierRepository->deleteSupplier($id);
    }
}