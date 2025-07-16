<?php
namespace App\Main\Fornecedor\Repository;

use App\Main\Fornecedor\Model\Fornecedor;
use App\Models\FornecedorModel;
use Illuminate\Database\Eloquent\Collection;

class FornecedorRepository implements FornecedorRepositoryInterface
{

    public function __construct(
        private FornecedorModel $fornecedor
    ){}

    public function persist(Fornecedor $fornecedor) : ?FornecedorModel
    {
        return $this->fornecedor->create(
            $fornecedor->toArray()
        );
    }
    public function findAll($offset, $limit) : Collection
    {
        return $this->fornecedor->query()->limit($limit)->offset($offset)
            ->get();
    }
    public function find(?int $id) : ?FornecedorModel
    {
        return $this->fornecedor->find($id);
    }
    public function delete(FornecedorModel $fornecedorModel)
    {
        $fornecedorModel->delete();
    }

    public function findByName(string $name): ?FornecedorModel
    {
        return $this->fornecedor->where("nome", $name)->first();
    }
}