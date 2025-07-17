<?php

namespace App\Repositories;

use App\Models\Fornecedor;

class FornecedorRepository implements FornecedorRepositoryInterface
{
    public function allPaginated($perPage = 10, $filters = [])
    {
        $query = Fornecedor::query();

        // Filtros
        if (!empty($filters['nome'])) {
            $query->where('nome', 'like', '%' . $filters['nome'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['cnpj'])) {
            $query->where('cnpj', 'like', '%' . $filters['cnpj'] . '%');
        }

        // Ordenação
        $sortBy = $filters['sort_by'] ?? 'id';
        $sortOrder = $filters['sort_order'] ?? 'desc';

        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    public function find($id)
    {
        return Fornecedor::findOrFail($id);
    }

    public function create(array $data)
    {
        return Fornecedor::create($data);
    }

    public function update($id, array $data)
    {

        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            throw new \Exception("Fornecedor não encontrado.");
        }
        $data['cnpj'] = $fornecedor->cnpj; // proteção contra alteração
        $fornecedor->update($data);
        return $fornecedor;
    }

    public function delete($id)
    {
        return Fornecedor::destroy($id);
    }
}
