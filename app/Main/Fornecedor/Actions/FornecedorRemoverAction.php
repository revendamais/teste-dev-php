<?php
namespace App\Main\Fornecedor\Actions;

use App\Main\Fornecedor\Exception\FornecedorException;
use App\Main\Fornecedor\Repository\FornecedorRepositoryInterface;

final class FornecedorRemoverAction
{
    public function __construct(
        private FornecedorRepositoryInterface $fornecedorRepository
    ){}

    public function execute($id)
    {
        $fornecedor = $this->fornecedorRepository->find($id);
        if (empty($fornecedor)) {
            throw new FornecedorException("registro não encontrado", 404);
        }
        $this->fornecedorRepository->delete($fornecedor);
    }
}