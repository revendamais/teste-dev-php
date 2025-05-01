<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface SupplierRepositoryInterface
{
    public function all(Request $request);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

}
