<?php
namespace App\Repositories;

interface FornecedorRepositoryInterface
{
    public function listar($perPage = 10);
    public function mostrar($id);
    public function create(array $data);
    public function atualizar(array $data, $id);
    public function deletar($id);
    public function findByDocumento($documento);
}
