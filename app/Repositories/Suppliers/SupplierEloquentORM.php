<?php

namespace App\Repositories\Suppliers;

use App\Models\Supplier;

class SupplierEloquentORM implements SupplierRepositoryInterface
{

    public function all(): array
    {
        $suppliers = Supplier::all();
        return [
            'data' => $suppliers,
        ];
    }
}
