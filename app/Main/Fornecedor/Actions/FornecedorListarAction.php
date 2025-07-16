<?php
namespace App\Main\Fornecedor\Actions;

use App\Http\Resources\FornecedorResource;
use App\Main\Fornecedor\Repository\FornecedorRepositoryInterface;

final class FornecedorListarAction
{
    public function __construct(
        private FornecedorRepositoryInterface $fornecedorRepository
    ){}

    public function listAll($request)
    {
        $limit = 10;
        $offset = (int)$request->offset;
        if ($offset === null || $offset !== 0) {
            $offset = 10;
        }
        return FornecedorResource::collection(
            $this->fornecedorRepository->findAll(
                $offset,
                $limit
            )
        );
    }
    public function listById($id)
    {
        return new FornecedorResource(
            $this->fornecedorRepository->find($id)
        );
    }
}