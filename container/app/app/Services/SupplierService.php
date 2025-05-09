<?php

namespace App\Services;

use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Services\DTO\SupplierDTO;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllSuppliers(array $requestFields): LengthAwarePaginator
    {
        $suppliers = $this->supplierRepository->all($requestFields);
        return $suppliers;
    }

    public function createSupplier(SupplierDTO $data)
    {
        $supplier = $this->supplierRepository->create($data->toArray());
        return $supplier;
    }

    public function getSupplierById($id)
    {
        try{
            $supplier =  $this->supplierRepository->find($id);
        }catch(RecordNotFoundException $e){
            throw new RecordNotFoundException($e->getMessage());
        }
        return $supplier;
    }

    public function updateSupplier(SupplierDTO $data)
    {
        try{
            $updatedData = $this->supplierRepository->update($data->getId(), $data->toArray());
        }catch(RecordNotFoundException $e){
            throw new RecordNotFoundException($e->getMessage());
        }
        return $updatedData;
    }

    public function deleteSupplier($id)
    {
        try{
            return $this->supplierRepository->delete($id);
        }catch(RecordNotFoundException $e){
            throw new RecordNotFoundException($e->getMessage());
        }
    }
}
