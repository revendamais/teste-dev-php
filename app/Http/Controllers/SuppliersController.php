<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function __construct(Protected SupplierService $supplierService)
    {}

    public function index(): JsonResponse
    {
        return response()->json($this->supplierService->all(), 200);
    }
}
