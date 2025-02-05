<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse {

        $query = Fornecedor::query();

        // Filtragem
        if ($request->has('nome')) {
            $query->where('nome', 'like', '%' . $request->input('nome') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        // Ordenação
        $sortBy = $request->get('sort_by', 'nome'); // Valor padrão 'nome'
        $order = $request->get('order', 'asc'); // Valor padrão 'asc'

        $fornecedores = $query->orderBy($sortBy, $order)->paginate(10);
        
        return response()->json($fornecedores);
        // return response()->json(Fornecedor::all());
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
    public function store(StoreFornecedorRequest $request): JsonResponse {
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
