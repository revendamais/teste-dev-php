<?php

namespace App\Repositories;

use App\Helpers\Cacher;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Resources\SupplierResource;
use App\Repositories\Interfaces\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{
    private $cacher;

    public function __construct()
    {
        $this->cacher = new Cacher('redis');
    }

    public function all(Request $request)
    {
        $request->validate([
            'order' => 'in:asc,desc',
            'per_page' => 'integer|min:1',
            'page' => 'integer|min:1',
        ]);
        return Supplier::paginate(page: $request->page ?? 1, perPage: $request->per_page ?? 20);
    }

    public function find($id) : SupplierResource
    {
        $supplier = Supplier::findOrFail($id);
        $cachedData = $this->cacher->getCached('supplier_'.$supplier->id);
        if ($cachedData) {
            $data = new SupplierResource($cachedData);
        } else {
            $this->cacher->setCached('supplier_'.$supplier->id, $supplier->toJson());
            $data = new SupplierResource($supplier);
        }
        return $data;
    }

    public function create(array $data) : Supplier
    {
        $supplier = Supplier::create($data);
        $this->cacher->setCached('supplier_'.$supplier->id, $supplier->toJson());
        return $supplier;
    }

    public function update($id, array $data) : Supplier
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);
        $supplier->refresh();
        $this->cacher->setCached('supplier_'.$supplier->id, $supplier->toJson());
        return $supplier;
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->cacher->removeCached('supplier_'.$id);
        return $supplier->forceDelete();
    }
}
