<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->supplierService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return $this->supplierService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier): JsonResponse
    {
        return $this->supplierService->show($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier): JsonResponse
    {
        return $this->supplierService->update($request, $supplier);
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        return $this->supplierService->destroy($supplier);

    }
}
