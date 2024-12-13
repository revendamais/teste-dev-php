<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService
{
    public function all(): array
    {
        $suppliers = Supplier::all();
        return [
            'data' => $suppliers,
        ];
    }
}
