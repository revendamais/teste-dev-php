<?php

namespace App\Repositories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Collection;

interface FornecedorRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Fornecedor;
    public function create(array $data): Fornecedor;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
