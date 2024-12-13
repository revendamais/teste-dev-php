<?php

namespace Tests\Feature\App\Suppliers;

use App\Models\Supplier;

/**
 * Validate the payload to create a new supplier.
 */
test('it should validate the supplier payload using form request', function () {
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
    $response->assertJsonStructure([
        'data' => ['id', 'nome', 'empresa', 'cnpjcpf', 'telefone', 'email', 'endereco'],
    ]);
});

test('it should fail with invalid email in form request', function () {
    $invalidPayload = [
        'nome' => 'Joe',
        'empresa' => 'Empresa 1',
        'cnpjcpf' => '12345678900000',
        'telefone' => '61999999999',
        'email' => 'invalid-email',
        'endereco' => 'Rua John Doe',
    ];

    $response = $this->postJson(route('suppliers.store'), $invalidPayload);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['email']);
});

