<?php

namespace App\Http\Controllers;

use App\DTO\Suppliers\CreateDTO;
use App\Http\Requests\SupplierRequest;
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

    public function store(SupplierRequest $request): JsonResponse
    {
        $supplier = $this->supplierService->create(
            CreateDTO::makeFromRequest($request)
        );

        return response()->json($supplier, $supplier['status']);
    }
}
