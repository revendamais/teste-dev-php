<?php

namespace App\Repositories;

interface FornecedorRepositoryInterface
{
    public function allPaginated($perPage, $filters = []);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
