<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\FornecedorRepositoryInterface;

use RafaelLaurindo\BrasilApi\BrasilApiFacade;
use LaravelLegends\PtBrValidator\Rules\Cnpj;

class FornecedorController extends Controller
{
    protected $fornecedorRepository;

    public function __construct(FornecedorRepositoryInterface $fornecedorRepository)
    {
        $this->fornecedorRepository = $fornecedorRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->fornecedorRepository->all($request));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($this->buscarPorCnpj($request->documento)){
            $fornecedor = $this->fornecedorRepository->create($request->all());
            return response()->json($fornecedor, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornecedor $fornecedor)
    {
        return response()->json($this->fornecedorRepository->find($fornecedor->id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $fornecedor = $this->fornecedorRepository->update($fornecedor->id, $request->all());
        return response()->json($fornecedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $this->fornecedorRepository->delete($fornecedor->id);
        return response()->json(['mensagem' => 'Fornecedor removido com sucesso.'], 204);
    }

    public function buscarPorCnpj($cnpj)
    {
        $validator = new Cnpj($cnpj);
        if($validator){
            $dados = BrasilApiFacade::findCnpj($cnpj);
            return response()->json($dados);
        }
    }
}
