<?php
namespace App\Main\Fornecedor\Actions;

use App\Http\Requests\FornecedorRequest;
use App\Http\Resources\FornecedorResource;
use App\Main\Fornecedor\Exception\FornecedorException;
use App\Main\Fornecedor\Model\Fornecedor;
use App\Main\Fornecedor\Repository\FornecedorRepositoryInterface;
use App\Services\ApiExternos\BuscaCnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

final class FornecedorCriarAction
{

    public function __construct(
        private FornecedorRepositoryInterface $fornecedorRepository
    ){}

    public function execute(FormRequest|FornecedorRequest $request)
    {
        $fornecedor = null;
        if ($this->fornecedorRepository->findByName($request->nome())?->exists()){
            throw new FornecedorException("Fornecedor já existe no sistema.");
        }
        
        DB::transaction(function() use($request, &$fornecedor) {
            $fornecedor = new Fornecedor(
                $request->nome(),
                $request->cpfCnpj(),
                $request->email(),
                $request->celular(),
                $request->endereco()
            );
    
            if ($fornecedor->isCnpj()) {
                /*
                    essa api pode ser feita no background
                    dependendo da regra de negocio.
                */
                $pessoaJuridica = (new BuscaCnpj($fornecedor))
                    ->handleCnpj()
                    ->loadConfig()
                    ->run()
                    //->throwIfFail()
                    ->toObject();
        
            }
            $fornecedor = $this->fornecedorRepository->persist($fornecedor);
        });
        return new FornecedorResource($fornecedor);
    }
}