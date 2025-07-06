<?php

namespace danielbastos\revendamais\Repositories\Interfaces;

use danielbastos\revendamais\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

interface SupplierRepositoryInterface {
    public function find(array $criteria): Collection;
    public function get($id): ?Supplier;
    public function create(array $data): Supplier;
    public function update($id, array $data): ?Supplier;
    public function delete($id): bool;
}
