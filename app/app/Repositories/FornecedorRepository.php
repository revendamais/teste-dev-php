<?php

namespace App\Repositories;

use App\Repositories\Interfaces\FornecedorRepositoryInterface;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorRepository implements FornecedorRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function all(Request $request)
    {
        $request->validate([
            'order' => 'in:asc,desc',
            'per_page' => 'integer|min:1',
            'page' => 'integer|min:1',
        ]);
        return Fornecedor::paginate(page: $request->page ?? 1, perPage: $request->per_page ?? 10);
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
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($data);
        return $fornecedor;
    }

    public function delete($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return $fornecedor->delete();
    }
}
