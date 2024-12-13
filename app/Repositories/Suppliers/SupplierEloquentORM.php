<?php

namespace App\Repositories\Suppliers;

use App\DTO\Suppliers\CreateDTO;
use App\DTO\Suppliers\UpdateDTO;
use App\Models\Supplier;
use Exception;
use Illuminate\Support\Facades\Log;

class SupplierEloquentORM implements SupplierRepositoryInterface
{
    public function __construct(
        protected Supplier $supplier,
    )
    {}

    public function all(): array
    {
        try {
            $suppliers = Supplier::all();
            return [
                'data' => $suppliers->toArray(),
                'status' => 200
            ];
        } catch (Exception $e) {
            Log::channel('dbException')->error('Error in retrieving all suppliers', ['error' => $e->getMessage()]);
            return [
                'data' => [],
                'message' => "An error occurred while retrieving the supplier list",
                'status' => 500,
            ];
        }
    }

    public function show(int $id): array
    {
        try {
            $supplier = $this->supplier->findOrFail($id);
            if (!$supplier)
            {
                return [
                    'data' => [],
                    'status' => 404,
                    'message' => 'Supplier not found'
                ];
            }
            return [
                'data' => $supplier->toArray(),
                'status' => 200
            ];
        } catch (Exception $e) {
            Log::channel('dbException')->error('Error in retrieving supplier', ['error' => $e->getMessage()]);
            return [
                'data' => [],
                'message' => "An error occurred while retrieving the supplier list",
                'status' => 500,
            ];
        }
    }

    public function create(CreateDTO $dto): array
    {
        try {
            $data = (array) $dto;
            $supplier = $this->supplier->create($data);

            return [
                'data' => $supplier->toArray(),
                'status' => 201
            ];
        } catch (Exception $e) {
            Log::channel('dbException')->error('Error in create new supplier', ['error' => $e->getMessage()]);
            return [
                'data' => [],
                'message' => "An error occurred while creating new supplier",
                'status' => 500,
            ];
        }
    }

    public function update(UpdateDTO $dto, int $id): array
    {
        try {
            $supplier = $this->supplier->find($id);

            if (!$supplier) {
                return [
                    'data' => [],
                    'message' => "Supplier not found",
                    'status' => 404
                ];
            }
            $data = (array) $dto;
            $supplier->update($data);
            return [
                'data' => $supplier->toArray(),
                'status' => 200
            ];
        } catch (Exception $e) {
            Log::channel('dbException')->error('Error in update supplier', ['error' => $e->getMessage()]);
            return [
                'data' => [],
                'message' => "An error occurred while updating supplier",
                'status' => 500,
            ];
        }
    }

    public function destroy(int $id): array
    {
        try {
            $supplier = $this->supplier->findOrFail($id);
            if (!$supplier) {
                return [
                    'data' => [],
                    'message' => "Supplier not found",
                    'status' => 404
                ];
            }

            $supplier->delete();

            return [
                'message' => "Supplier successfully deleted",
                'status' => 200
            ];
        } catch (Exception $e) {
            Log::channel('dbException')->error('Error in delete supplier', ['error' => $e->getMessage()]);
            return [
                'data' => [],
                'message' => "An error occurred while deleting supplier",
                'status' => 500,
            ];
        }
    }
}
