<?php

namespace Tests\Feature\App\Suppliers;

use App\Models\Supplier;

/**
 * create a new supplier.
 */
it('should insert a new supplier', function () {
    $payload = [
        'nome' => 'Joe',
        'empresa' => 'Empresa 1',
        'cnpjcpf' => '12345678900000',
        'telefone' => '61999999999',
        'email' => 'joe@email.com',
        'endereco' => 'Rua John Doe',
    ];

    $response = $this->postJson(route('suppliers.store'), $payload);

    $response->assertStatus(201);

    // Verifica se os dados estão dentro do campo "data"
    $response->assertJsonFragment([
        'nome' => 'Joe',
        'empresa' => 'Empresa 1',
        'cnpjcpf' => '12345678900000',
        'telefone' => '61999999999',
        'email' => 'joe@email.com',
        'endereco' => 'Rua John Doe',
    ]);

    // Verifica se os dados também estão no banco
    $this->assertDatabaseHas('suppliers', [
        'email' => 'joe@email.com',
    ]);

    $response->assertCreated();
});

