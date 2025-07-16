<?php
namespace App\Main\Fornecedor\Repository;

use App\Main\Fornecedor\Model\Fornecedor;
use App\Models\FornecedorModel;
use Illuminate\Database\Eloquent\Collection;

interface FornecedorRepositoryInterface
{

    public function persist(Fornecedor $fornecedor) : ?FornecedorModel;
    public function findAll($offset, $limit) : Collection;
    public function find(?int $id) : ?FornecedorModel;
    public function delete(FornecedorModel $fornecedorModel);
    public function findByName(string $name): ?FornecedorModel;
    
}