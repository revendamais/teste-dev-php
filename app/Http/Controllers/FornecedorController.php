<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Models\Fornecedor;
use App\Repositories\FornecedorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    private $fornecedorRepository;

    public function __construct(FornecedorRepositoryInterface $fornecedorRepository)
    {
        $this->fornecedorRepository = $fornecedorRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {

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
     * Store a newly created resource in storage.
     */
    public function store(StoreFornecedorRequest $request): JsonResponse
    {
        // $fornecedor = Fornecedor::create($request->all());
        $fornecedor = $this->fornecedorRepository->create($request->all());
        return response()->json($fornecedor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $fornecedor = $this->fornecedorRepository->find($id);
        return response()->json($fornecedor);
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
    public function update(UpdateFornecedorRequest $request, $id): JsonResponse
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($request->all());
        return response()->json($fornecedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->fornecedorRepository->delete($id);
        return response()->json(['message' => 'Fornecedor deletado com sucesso!'], 204);
    }
}
