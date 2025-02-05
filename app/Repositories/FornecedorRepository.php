<?php

namespace App\Repositories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Collection;

class FornecedorRepository implements FornecedorRepositoryInterface
{
    public function all(): Collection
    {
        return Fornecedor::all();
    }

    public function find(int $id): ?Fornecedor
    {
        return Fornecedor::find($id);
    }

    public function create(array $data): Fornecedor
    {
        return Fornecedor::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $fornecedor = $this->find($id);
        if (!$fornecedor) {
            return false;
        }
        return $fornecedor->update($data);
    }

    public function delete(int $id): bool
    {
        $fornecedor = $this->find($id);
        if (!$fornecedor) {
            return false;
        }
        return $fornecedor->delete();
    }
}
