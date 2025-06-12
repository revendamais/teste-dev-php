<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Resources\FornecedorResource;
use App\Services\FornecedorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class FornecedorController extends Controller
{
    protected FornecedorService $service;

public function __construct(FornecedorService $service)
{
    $this->service = $service;
}


public function index(Request $request)
{
    $filtros = $request->only(['search', 'sort', 'order', 'page']);

    return $this->service->listar($filtros);
}



    public function store(StoreFornecedorRequest $request)
    {
        try {
            $fornecedor = $this->service->criar($request->validated());
            return new FornecedorResource($fornecedor);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function show($id)
    {
        return new FornecedorResource($this->service->mostrar($id));
    }

public function update(StoreFornecedorRequest $request, $id)
{
    $fornecedor = $this->service->atualizar($id, $request->validated());
    return new FornecedorResource($fornecedor);
}


    public function destroy($id): JsonResponse
    {
        $deletado = $this->service->deletar($id);
        return response()->json([
            'message' => $deletado ? 'Fornecedor deletado com sucesso.' : 'Fornecedor não encontrado.'
        ], $deletado ? 200 : 404);
    }
}
