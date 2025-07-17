<?php
namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Services\BrasilApiService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Repositories\FornecedorRepositoryInterface;

class FornecedorController extends Controller
{
    protected $fornecedores;

    public function __construct(FornecedorRepositoryInterface $fornecedores)
    {
        $this->fornecedores = $fornecedores;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'nome', 'email', 'cnpj', 'sort_by', 'sort_order'
        ]);
        $perPage = $request->get('per_page', 10);

        $fornecedores = $this->fornecedores->allPaginated($perPage, $filters);

        return response()->json($fornecedores);
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'nome'              => 'required|string|max:255',
            'contato_numero'    => 'required|string|max:11',
            'contato_nome'      => 'required|string|max:255',
            'endereco_cep'      => 'required|string|max:255',
            'endereco_rua'      => 'required|string|max:255',
            'endereco_numero'   => 'required|numeric',
            'endereco_cidade'   => 'required|string|max:255',
            'endereco_estado'   => 'required|string|max:255',
            'cnpj'              => 'required|digits:14|unique:fornecedores,cnpj',
        ]);

        try {
            $fornecedor = $this->fornecedores->create($validatedData);

            if (!$fornecedor) {
                return response()->json([
                    'message' => 'Fornecedor não foi salvo.',
                ], 500);
            }

            return response()->json([
                'message' => 'Fornecedor criado com sucesso!',
                'fornecedor' => $fornecedor
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Erro ao criar fornecedor: ' . $e->getMessage());

            return response()->json([
                'message' => 'Erro ao criar o fornecedor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome'              => 'sometimes|required|string|max:255',
            'contato_numero'    => 'sometimes|required|string|max:11',
            'contato_nome'      => 'sometimes|required|string|max:255',
            'endereco_cep'      => 'sometimes|required|string|max:255',
            'endereco_rua'      => 'sometimes|required|string|max:255',
            'endereco_numero'   => 'sometimes|required|numeric',
            'endereco_cidade'   => 'sometimes|required|string|max:255',
            'endereco_estado'   => 'sometimes|required|string|max:255',
            'email'             => 'sometimes|required|email|unique:fornecedores,email,' . $id,
            'cpf'               => 'sometimes|required|string|unique:fornecedores,cpf,' . $id,
            // NÃO permitir alteração do CNPJ
            'cnpj'              => 'prohibited',
        ]);

        try {
            $fornecedor = $this->fornecedores->update($id, $validatedData);

            return response()->json([
                'message' => 'Fornecedor atualizado com sucesso!',
                'fornecedor' => $fornecedor
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar fornecedor: ' . $e->getMessage());

            return response()->json([
                'message' => 'Erro ao atualizar o fornecedor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->fornecedores->delete($id);

            return response()->json([
                'message' => 'Fornecedor excluído com sucesso!'
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Erro ao excluir fornecedor: ' . $e->getMessage());

            return response()->json([
                'message' => 'Erro ao excluir fornecedor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function buscarCnpj($cnpj, BrasilApiService $brasilApi)
    {
        $dados = $brasilApi->consultarCNPJ($cnpj);

        if (!$dados) {
            return response()->json(['erro' => 'CNPJ não encontrado'], 404);
        }
        return response()->json($dados);
    }
}
