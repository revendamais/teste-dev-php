<?php

namespace Tests\Feature\App\Suppliers;

use App\Models\Supplier;

test('it should delete the supplier', function () {
    Supplier::factory()->count(5)->create();

    $supplier = Supplier::first();

    $this->assertDatabaseHas(Supplier::class, [
        'id' => $supplier->id,
        'nome' => $supplier->nome,
        'empresa' => $supplier->empresa,
        'cnpjcpf' => $supplier->cnpjcpf,
        'telefone' => $supplier->telefone,
        'email' => $supplier->email,
        'endereco' => $supplier->endereco,
    ]);

    $response = $this->deleteJson(route('suppliers.destroy', ['id' => $supplier->id]));

    $response->assertOk();
});
