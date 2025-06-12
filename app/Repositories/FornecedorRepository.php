<?php
namespace App\Repositories;

use App\Models\Fornecedor;

class FornecedorRepository implements FornecedorRepositoryInterface
{
    public function listar($perPage = 10)
    {
        return Fornecedor::orderBy('nome')->paginate($perPage);
    }

    public function mostrar($id)
    {
        return Fornecedor::findOrFail($id);
    }

    public function create(array $data)
    {
        return Fornecedor::create($data);
    }

    public function atualizar(array $data, $id)
    {
        $fornecedor = $this->mostrar($id);
        $fornecedor->update($data);
        return $fornecedor;
    }

    public function deletar($id)
    {
        return Fornecedor::destroy($id);
    }

    public function findByDocumento($documento)
    {
        return Fornecedor::where('documento', $documento)->first();
    }
}
