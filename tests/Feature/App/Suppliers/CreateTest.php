<?php

namespace Tests\Feature\App\Suppliers;

/**
 * create a new supplier.
 */
it('should insert a new supplier', function () {
    $payload = [
        'company' => 'Empresa 1',
        'cnpjcpf' => '12345678900000',
        'phone' => '61999999999',
        'email' => 'joe@email.com',
        'address' => 'Rua John Doe',
    ];

    $response = $this->postJson(route('suppliers.store'), $payload);

    $response->assertStatus(201);

    $response->assertJsonFragment([
        'company' => 'Empresa 1',
        'cnpjcpf' => '12345678900000',
        'phone' => '61999999999',
        'email' => 'joe@email.com',
        'address' => 'Rua John Doe',
    ]);

    $this->assertDatabaseHas('suppliers', [
        'email' => 'joe@email.com',
    ]);

    $response->assertCreated();
});

