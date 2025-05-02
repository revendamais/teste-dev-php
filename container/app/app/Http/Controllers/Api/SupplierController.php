<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierCollection;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $suppliers = $this->supplierRepository->all($request);
        return new SupplierCollection($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $supplier = $this->supplierRepository->create($data);
        return response()->json(new SupplierResource($supplier), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier): JsonResponse
    {
        $data =  $this->supplierRepository->find($supplier->id);
        return response()->json(new SupplierResource($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier): JsonResponse
    {
        $data = $request->validated();
        $updatedData = new SupplierResource($this->supplierRepository->update($supplier->id, $data));
        return response()->json($updatedData);
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Supplier $supplier): Response
    {
        $this->supplierRepository->delete($supplier->id);
        return response()->noContent();
    }
}
