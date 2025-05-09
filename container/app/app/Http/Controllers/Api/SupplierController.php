<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierIndexRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Services\SupplierService;
use Illuminate\Database\RecordNotFoundException;

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
    public function index(SupplierIndexRequest $request)
    {
        return ApiResponseClass::sendResponse($this->supplierService->getAllSuppliers($request), '',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierCreateRequest $request): JsonResponse
    {
        $create = $this->supplierService->createSupplier($request);
        return ApiResponseClass::sendResponse($create, '',201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try{
            $data = $this->supplierService->getSupplierById($id);
        }catch(RecordNotFoundException $e){
            return ApiResponseClass::sendResponse('','Supplier Not found',404);
        }
        return ApiResponseClass::sendResponse($data, '',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierUpdateRequest $request, $id): JsonResponse
    {
        try{
            $action = $this->supplierService->updateSupplier($request, $id);
        }catch(RecordNotFoundException $e){
            return ApiResponseClass::sendResponse('','Supplier Not found',404);
        }
        return ApiResponseClass::sendResponse($action, '',200);
    }

    /**
     * Delete the specified resource.
     */
    public function destroy($id): JsonResponse
    {
        try{
            $delete = $this->supplierService->deleteSupplier($id);
            if($delete){
                return ApiResponseClass::sendResponse('','',204);
            }else{
                return ApiResponseClass::sendResponse('','The DELETE operation was not successful',400);
            }
        }catch(RecordNotFoundException $e){
            return ApiResponseClass::sendResponse('','Supplier Not found',404);
        }
    }
}
