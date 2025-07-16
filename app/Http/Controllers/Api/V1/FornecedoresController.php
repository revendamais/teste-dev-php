<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FornecedorRequest;
use App\Main\Fornecedor\Actions\FornecedorAtualizarAction;
use App\Main\Fornecedor\Actions\FornecedorCriarAction;
use App\Main\Fornecedor\Actions\FornecedorListarAction;
use App\Main\Fornecedor\Actions\FornecedorRemoverAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Container\ContainerInterface;

class FornecedoresController extends Controller
{
    public function __construct(
        private ContainerInterface $container
    ){}


    public function index(Request $request)
    {
        /** @var FornecedorListarAction $FornecedorListarAction */
        $FornecedorListarAction = $this->container->get(FornecedorListarAction::class);
        $response = $FornecedorListarAction->listAll($request);
        return response([
            "data" => $response,
            "message" => "listando os fornecedores (paginando)."
        ]);
        
    }
    public function store(FornecedorRequest $request)
    {
        /** @var FornecedorCriarAction $fornecedorCriarAction */
        $fornecedorCriarAction = $this->container->get(FornecedorCriarAction::class);
        $response = $fornecedorCriarAction->execute($request);
        return response([
            "data" => $response,
            "message" => "fornecedor criado com successo"
        ],
        Response::HTTP_CREATED
    );
        
    }

    public function show($id)
    {
        /** @var FornecedorListarAction $fornecedorListarAction */
        $fornecedorListarAction = $this->container->get(FornecedorListarAction::class);
        $response = $fornecedorListarAction->listById($id);
        return response([
                "data" => $response,
                "message" => "mostrando o forncedor: [$id]"
            ],
            Response::HTTP_OK
        );
    }

    public function update(FornecedorRequest $request)
    {
        /** @var FornecedorAtualizarAction $fornecedorAtualizarAction */
        $fornecedorAtualizarAction = $this->container->get(FornecedorAtualizarAction::class);
        $response = $fornecedorAtualizarAction->execute($request);
        return response([
                "data" => $response,
                "message" => "Fornecedor atualizado com sucesso"
            ],
            Response::HTTP_OK
        );
    }

    public function delete($id)
    {
        /** @var FornecedorRemoverAction $fornecedorRemoverAction */
        $fornecedorRemoverAction = $this->container->get(FornecedorRemoverAction::class);
        $fornecedorRemoverAction->execute($id);
        return response([
                "data" => [],
                "message" => "Fornecedor removido com sucesso"
            ],
            Response::HTTP_OK
        );
    }
}
