<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse {
        return response()->json(Fornecedor::all());
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse {
        $request->validate([
            'nome' => 'required|string',
            'tipo' => 'required|in:Física,Jurídica',
            'documento' => 'required|unique:fornecedores',
            'email' => 'required|email|unique:fornecedores',
            'telefone' => 'required',
            'endereco' => 'required',
        ]);
        $fornecedor = Fornecedor::create($request->all());
        
        return response()->json($fornecedor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse {
        return response()->json(Fornecedor::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($request->all());
        return response()->json($fornecedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse {
        Fornecedor::destroy($id);
        return response()->json(['message' => 'Fornecedor deletado com sucesso!'], 204);
        // return response()->noContent(); // Retorna 204 sem mensagem
    }
}
