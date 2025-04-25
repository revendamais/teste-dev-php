<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\FornecedorRepositoryInterface;
use RafaelLaurindo\BrasilApi\BrasilApiFacade;
use LaravelLegends\PtBrValidator\Rules\Cnpj;
use App\Classes\ResponseClass;
use App\Http\Requests\FornecedorCreateRequest;
use App\Http\Requests\FornecedorUpdateRequest;
use App\Http\Resources\FornecedorRecurso;
use Illuminate\Support\Facades\DB;

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
        $data = $this->fornecedorRepository->all($request);
        return ApiResponseClass::sendResponse(FornecedorRecurso::collection($data),200);
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
    public function store(FornecedorCreateRequest $request)
    {
        $data = [
            "nome" => $request->nome,
            "documento" => $request->documento,
            "email" => $request->email,
            "telefone" => $request->telefone,
            "endereco"=> $request->endereco
        ];
        DB::beginTransaction();
        try{
            $fornecedor = $this->fornecedorRepository->create($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new FornecedorRecurso($fornecedor),'Fornecedor criado com sucesso', 201);
        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fornecedor = $this->fornecedorRepository->find($id);
        return ApiResponseClass::sendResponse(new FornecedorRecurso($fornecedor),'',200);
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
    public function update(FornecedorUpdateRequest $request, $id)
    {
        $data = [
            "nome" => $request->nome,
            "documento" => $request->documento,
            "email" => $request->email,
            "telefone" => $request->telefone,
            "endereco"=> $request->endereco
        ];
        DB::beginTransaction();
        try{
            $fornecedor = $this->fornecedorRepository->update($id, $data);
            return ApiResponseClass::sendResponse(new FornecedorRecurso($fornecedor),'Fornecedor atualizado com sucesso', 200);
        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->fornecedorRepository->delete($id);
        return ApiResponseClass::sendResponse(null,"Fornecedor removido com sucesso", 204);
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
