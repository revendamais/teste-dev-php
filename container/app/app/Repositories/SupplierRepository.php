<?php

namespace App\Repositories;

use App\Helpers\Cacher;
use App\Models\Supplier;
use App\Http\Resources\SupplierResource;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Database\RecordNotFoundException;

class SupplierRepository implements SupplierRepositoryInterface
{
    private $cacher;

    public function __construct()
    {
        $this->cacher = new Cacher('redis');
    }

    public function all(array $data)
    {
        return Supplier::orderBy($data["order_by"] ?? 'name',$data["order"] ?? 'asc')
        ->paginate(page: $data["page"] ?? 1, perPage: $data["per_page"] ?? 20);
    }

    public function find($id) : SupplierResource
    {
        $cachedData = $this->cacher->getCached('supplier_'.$id);
        if ($cachedData) {
            $data = new SupplierResource($cachedData);
        } else {
            try{
                $supplier = Supplier::findOrFail($id);
            }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                throw new RecordNotFoundException("Id:`$id` not found");
            }
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
        try{
            $supplier = Supplier::findOrFail($id);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            throw new RecordNotFoundException("Id:`$id` not found");
        }
        $supplier->update($data);
        $supplier->refresh();
        $this->cacher->setCached('supplier_'.$supplier->id, $supplier->toJson());
        return $supplier;
    }

    public function delete($id)
    {
        try{
            $supplier = Supplier::findOrFail($id);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            throw new RecordNotFoundException("Id:`$id` not found");
        }
        $this->cacher->removeCached('supplier_'.$id);
        return $supplier->forceDelete();
    }
}
