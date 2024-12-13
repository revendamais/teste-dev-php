<?php

namespace App\Http\Controllers;

use App\Services\Suppliers\SupplierService;
use Illuminate\Http\JsonResponse;

class SuppliersController extends Controller
{
    public function __construct(protected SupplierService $supplierService)
    {}

    public function index(): JsonResponse
    {
        $suppliers = $this->supplierService->all();
        return response()->json($suppliers, $suppliers['status']);
    }
}
