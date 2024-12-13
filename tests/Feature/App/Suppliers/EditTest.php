<?php

namespace Tests\Feature\App\Suppliers;

use App\Models\Supplier;

test('it should edit the supplier', function () {
    $supplier = Supplier::first();

    $data = Supplier::factory()->make();

    $this->assertDatabaseHas(Supplier::class, [
        'id' => $supplier->id,
        'nome' => $supplier->nome,
        'empresa' => $supplier->empresa,
        'cnpjcpf' => $supplier->cnpjcpf,
        'telefone' => $supplier->telefone,
        'email' => $supplier->email,
        'endereco' => $supplier->endereco,
    ]);

    $payload = [
        'nome' => $data->nome,
        'empresa' => $data->empresa,
        'cnpjcpf' => $data->cnpjcpf,
        'telefone' => $data->telefone,
        'email' => $data->email,
        'endereco' => $data->endereco,
    ];

    $response = $this->putJson(route('suppliers.update', ['id' => $supplier->id]), $payload);

    $this->assertDatabaseHas(Supplier::class, [
        'id' => $supplier->id,
        'nome' => $data->nome,
        'empresa' => $data->empresa,
        'cnpjcpf' => $data->cnpjcpf,
        'telefone' => $data->telefone,
        'email' => $data->email,
        'endereco' => $data->endereco,
    ]);

    $response->assertOk();
});

