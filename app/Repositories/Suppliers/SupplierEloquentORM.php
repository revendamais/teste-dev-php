<?php

namespace App\Repositories\Suppliers;

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
                'data' => $suppliers,
                'status' => 200
            ];
        } catch (Exception $e) {
            Log::channel('dbException')->error('Ocorreu um erro no processo', ['error' => $e->getMessage()]);
            return [
                'data' => [],
                'message' => "An error occurred while retrieving the supplier list",
                'status' => 500,
            ];
        }
    }
}
