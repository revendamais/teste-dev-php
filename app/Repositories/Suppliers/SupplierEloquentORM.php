<?php

namespace App\Repositories\Suppliers;

use App\DTO\Suppliers\CreateDTO;
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
}
