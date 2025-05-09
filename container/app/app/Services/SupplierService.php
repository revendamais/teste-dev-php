<?php

namespace App\Services;

use App\Models\Supplier;
use App\Classes\ApiResponseClass;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierCollection;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierIndexRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Http\JsonResponse;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllSuppliers(SupplierIndexRequest $request): SupplierCollection
    {
        $data = $request->validated();
        $suppliers = $this->supplierRepository->all($data);
        return new SupplierCollection($suppliers);
    }

    public function createSupplier(SupplierCreateRequest $request): SupplierResource
    {
        $data = $request->validated();
        $supplier = $this->supplierRepository->create($data);
        return new SupplierResource($supplier);
    }

    public function getSupplierById($id): SupplierResource
    {
        try{
            $supplier =  $this->supplierRepository->find($id);
        }catch(RecordNotFoundException $e){
            throw new RecordNotFoundException($e->getMessage());
        }
        return new SupplierResource($supplier);
    }

    public function updateSupplier(SupplierUpdateRequest $request, $id): SupplierResource
    {
        $data = $request->validated();
        try{
            $updatedData = new SupplierResource($this->supplierRepository->update($id, $data));
        }catch(RecordNotFoundException $e){
            throw new RecordNotFoundException($e->getMessage());
        }
        return new SupplierResource($updatedData);
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
