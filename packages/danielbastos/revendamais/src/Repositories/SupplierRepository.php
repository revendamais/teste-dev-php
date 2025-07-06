<?php

namespace danielbastos\revendamais\Repositories;

use danielbastos\revendamais\Models\Supplier;
use danielbastos\revendamais\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository implements SupplierRepositoryInterface
{
    private function getColumns() {
        $model = new Supplier();
        return $model->getFillable();
    }

    private function buildCriteria(array $criteria): array
    {
        $res = [];

        if (isset($criteria['id']))            $res['where'][] = ['id', $criteria['id']];
        if (isset($criteria['document']))      $res['where'][] = ['document', $criteria['document']];
        if (isset($criteria['name']))          $res['where'][] = ['name', 'ilike', '%' . $criteria['name'] . '%'];
        if (isset($criteria['business_name'])) $res['where'][] = ['business_name', 'ilike', '%' . $criteria['business_name'] . '%'];
        if (isset($criteria['email']))         $res['where'][] = ['email', 'ilike', '%' . $criteria['email'] . '%'];

        $res['order']     = isset($criteria['order']) && in_array($criteria['order'], $this->getColumns()) ? $criteria['order'] : 'id';
        $res['direction'] = isset($criteria['direction']) ? $criteria['direction'] : 'asc';
        $res['limit']     = 0+ isset($criteria['limit']) ? $criteria['limit'] : 10;

        return $res;
    }

    public function find(array $criteria): Collection
    {
        $query = Supplier::query();

        $buildCriteria = $this->buildCriteria($criteria);
        return Supplier::where($buildCriteria ['where'] ?? [])
            ->orderBy($buildCriteria['order'], $buildCriteria['direction'])
            ->limit($buildCriteria['limit'])
            ->get();
    }

    public function get($id): ?Supplier
    {
        return Supplier::find($id);
    }

    public function create(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function update($id, array $data): ?Supplier
    {
        $model = Supplier::find($id);
        if ($model) $model->update($data);
        return $model;
    }

    public function delete($id): bool
    {
        $model = Supplier::find($id);
        return $model ? $model->delete() : false;
    }
}
