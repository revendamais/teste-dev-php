<?php

namespace Tests\Feature\App\Suppliers;

use App\Models\Supplier;

test('it should edit the supplier', function () {
    $supplier = Supplier::first();

    $data = Supplier::factory()->make();

    $this->assertDatabaseHas(Supplier::class, [
        'id' => $supplier->id,
        'name' => $supplier->name,
        'company' => $supplier->company,
        'cnpjcpf' => $supplier->cnpjcpf,
        'phone' => $supplier->phone,
        'email' => $supplier->email,
        'address' => $supplier->address,
    ]);

    $payload = [
        'name' => $data->name,
        'company' => $data->company,
        'cnpjcpf' => $data->cnpjcpf,
        'phone' => $data->phone,
        'email' => $data->email,
        'address' => $data->address,
    ];

    $response = $this->putJson(route('suppliers.update', ['id' => $supplier->id]), $payload);

    $this->assertDatabaseHas(Supplier::class, [
        'id' => $supplier->id,
        'name' => $data->name,
        'company' => $data->company,
        'cnpjcpf' => $data->cnpjcpf,
        'phone' => $data->phone,
        'email' => $data->email,
        'address' => $data->address,
    ]);

    $response->assertOk();
});

