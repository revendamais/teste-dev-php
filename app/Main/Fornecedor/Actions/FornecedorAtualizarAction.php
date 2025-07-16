<?php
namespace App\Main\Fornecedor\Actions;

use App\Http\Requests\FornecedorRequest;
use App\Main\Fornecedor\Exception\FornecedorException;
use App\Main\Fornecedor\Model\Fornecedor;
use App\Main\Fornecedor\Repository\FornecedorRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

final class FornecedorAtualizarAction
{
    public function __construct(
        private FornecedorRepositoryInterface $fornecedorRepository
    ){}

    public function execute(FormRequest|FornecedorRequest $request)
    {
        $fornecedor = $this->fornecedorRepository->find($request->id());
        if (empty($fornecedor)) {
            throw new FornecedorException("Registro não encontrado");
        }
        //pode ser verificado se o atributo está sendo editado antes de fazer a attribuição 
        $fornecedor = new Fornecedor(
            $request->nome(),
            $request->cpfCnpj(),
            $request->email(),
            $request->celular(),
            $request->endereco(),
            $fornecedor->id
        );
        $this->fornecedorRepository->persist($fornecedor);
        return $fornecedor;
    }
}