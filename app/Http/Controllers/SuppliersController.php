<?php

namespace App\Http\Controllers;

use App\Services\Suppliers\SupplierService;
use Illuminate\Http\JsonResponse;

class SuppliersController extends Controller
{
    public function __construct(Protected SupplierService $supplierService)
    {}

    public function index(): JsonResponse
    {
        return response()->json($this->supplierService->all(), 200);
    }
}
