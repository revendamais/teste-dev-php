<?php

namespace Tests\Feature\App\Suppliers;

use App\Models\Supplier;

test('it should delete the supplier', function () {
    Supplier::factory()->count(5)->create();

    $supplier = Supplier::first();

    $this->assertDatabaseHas(Supplier::class, [
        'id' => $supplier->id,
        'name' => $supplier->name,
        'company' => $supplier->company,
        'cnpjcpf' => $supplier->cnpjcpf,
        'phone' => $supplier->phone,
        'email' => $supplier->email,
        'address' => $supplier->address,
    ]);

    $response = $this->deleteJson(route('suppliers.destroy', ['id' => $supplier->id]));

    $response->assertOk();
});
