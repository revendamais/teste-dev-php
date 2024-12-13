<?php

namespace App\Http\Controllers;

use App\DTO\Suppliers\CreateDTO;
use App\DTO\Suppliers\UpdateDTO;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Services\Suppliers\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function __construct(protected SupplierService $supplierService)
    {}

    public function index(Request $request): JsonResponse
    {
        $suppliers = $this->supplierService->all();
        return response()->json($suppliers, $suppliers['status']);
    }

    public function show(int $id): JsonResponse
    {
        $supplier = $this->supplierService->show($id);
        return response()->json($supplier, $supplier['status']);
    }

    public function store(SupplierStoreRequest $request): JsonResponse
    {
        $supplier = $this->supplierService->create(
            CreateDTO::makeFromRequest($request)
        );

        return response()->json($supplier, $supplier['status']);
    }

    public function update(SupplierUpdateRequest $request, int $id): JsonResponse
    {
        $supplier = $this->supplierService->update(
            UpdateDTO::makeFromRequest($request),
            $id
        );
        return response()->json($supplier, $supplier['status']);
    }
}
