<?php
namespace App\Services;

use App\Models\Fornecedor;
use App\Repositories\FornecedorRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FornecedorService
{
    protected $repository;

    public function __construct(FornecedorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

public function listar(array $filtros)
{
    // Cria uma chave única baseada nos filtros
    $cacheKey = 'fornecedores:' . md5(json_encode($filtros));

    return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($filtros) {
        $query = Fornecedor::query();

        if (!empty($filtros['search'])) {
            $search = $filtros['search'];
            $query->where('nome', 'like', "%{$search}%")
                  ->orWhere('documento', 'like', "%{$search}%");
        }

        if (!empty($filtros['sort']) && !empty($filtros['order'])) {
            $query->orderBy($filtros['sort'], $filtros['order']);
        }

        return $query->paginate(10);
    });
}

    public function mostrar($id)
    {
        return $this->repository->mostrar($id);
    }

    public function criar(array $data)
    {
        if ($data['tipo_documento'] === 'CNPJ') {
            $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/{$data['documento']}");
            if (!$response->successful()) {
                throw new \Exception('CNPJ inválido ou não encontrado na BrasilAPI');
            }
        }

        return $this->repository->create($data);
    }

    public function atualizar($id, array $data)
    {
    $fornecedor = $this->mostrar($id);
    $fornecedor->update($data);
    return $fornecedor;
    }

    public function deletar($id)
    {
        return $this->repository->deletar($id);
    }

    public function findByDocumento($documento)
    {
        return $this->repository->findByDocumento($documento);
    }
}
