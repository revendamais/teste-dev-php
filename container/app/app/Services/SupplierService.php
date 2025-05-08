<?php

namespace App\Services;

use App\Models\Supplier;
use App\Classes\ApiResponseClass;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierCollection;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Repositories\Interfaces\SupplierRepositoryInterface;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index(Request $request)
    {
        $suppliers = $this->supplierRepository->all($request);
        return ApiResponseClass::sendResponse(new SupplierCollection($suppliers), '',200);
    }

    public function store(SupplierCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $supplier = $this->supplierRepository->create($data);
        return ApiResponseClass::sendResponse(new SupplierResource($supplier), '',201);
    }

    public function show(Supplier $supplier): JsonResponse
    {
        $supplier =  $this->supplierRepository->find($supplier->id);
        return ApiResponseClass::sendResponse(new SupplierResource($supplier), '',200);
    }

    public function update(SupplierUpdateRequest $request, Supplier $supplier): JsonResponse
    {
        $data = $request->validated();
        $updatedData = new SupplierResource($this->supplierRepository->update($supplier->id, $data));
        return ApiResponseClass::sendResponse(new SupplierResource($updatedData), '',200);
    }

    public function destroy(Supplier $supplier): JsonResponse
    {
        $this->supplierRepository->delete($supplier->id);
        return ApiResponseClass::sendResponse('','',204);
    }
}
