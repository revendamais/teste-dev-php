<?php

declare(strict_types=1);

namespace App\Suppliers\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\BrasilApi\Services\BrasilApiService;
use App\Suppliers\Http\Requests\StoreOrUpdateSupplierRequest;
use App\Suppliers\Interfaces\SuppliersRepositoryInterface;
use App\Suppliers\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function __construct(
        private SuppliersRepositoryInterface $suppliersRepository,
    )
    {
    }

    public function index(): JsonResponse
    {
        try {
            $suppliers = $this->suppliersRepository->findAll();

            return response()->json([
                'status' => 'success',
                'message' => 'Fornecedores encontrados com sucesso!',
                'data' => $suppliers,
            ], 200);
        } catch (\Throwable $exception) {
            Log::error('Erro ao listar fornecedores: ' . $exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao listar fornecedores.',
            ], 500);
        }
    }


    public function store(StoreOrUpdateSupplierRequest $request): JsonResponse
    {
        try {
            $supplierData = $request->validated();

            $newSupplier = $this->suppliersRepository->save(new Supplier($supplierData));

            return response()->json([
                'status' => 'success',
                'message' => 'Fornecedor criado com sucesso!',
                'data' => $newSupplier,
            ], 201);
        } catch (\Throwable $exception) {
            Log::error('Erro ao criar fornecedor: ' . $exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao criar fornecedor.',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }

    public function show(int $supplierId): JsonResponse
    {
        try {
            $supplier = $this->suppliersRepository->find($supplierId);

            return response()->json([
                'status' => 'success',
                'message' => 'Fornecedor localizado com sucesso!',
                'data' => $supplier,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fornecedor não encontrado.',
            ], 404);
        } catch (\Throwable $exception) {
            Log::error('Erro ao localizar fornecedor: ' . $exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao localizar fornecedor.',
            ], 500);
        }
    }

    public function update(StoreOrUpdateSupplierRequest $request, int $supplierId): JsonResponse
    {
        try {
            $updatedData = $request->validated();

            $updatedSupplier = $this->suppliersRepository->update($supplierId, $updatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Fornecedor atualizado com sucesso!',
                'data' => $updatedSupplier,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fornecedor não encontrado.',
            ], 404);
        } catch (\Throwable $exception) {
            Log::error('Erro ao atualizar fornecedor: ' . $exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar fornecedor.',
            ], 500);
        }
    }


    public function destroy(int $supplierId): JsonResponse
    {
        try {
            $this->suppliersRepository->delete($supplierId);

            return response()->json([
                'status' => 'success',
                'message' => 'Fornecedor excluído com sucesso!',
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fornecedor não encontrado.',
            ], 404);
        } catch (\Throwable $exception) {
            Log::error('Erro ao excluir fornecedor: ' . $exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao excluir fornecedor.',
            ], 500);
        }
    }
    
}