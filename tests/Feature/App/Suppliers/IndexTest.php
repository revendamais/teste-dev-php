<?php

namespace Tests\Feature\App\Suppliers;

use App\Models\Supplier;

/**
* This return a suppliers list
*/
test('it should return suppliers list', function () {
    // arrange
    $suppliers = Supplier::factory()->make();
    // act
    $response = $this->getJson(route('suppliers.index'));
    // assert
    $response->assertOk()
             ->assertJsonFragment(['id' => $suppliers->first()->id]);
});

/**
 * This return a supplier by id
 */

test('it should return a supplier by id', function () {
    $supplier = Supplier::first();

    $response = $this->getJson(route('suppliers.show', ['id' => $supplier->id]));

    $response->assertOk()
        ->assertJsonFragment(['id' => $supplier->first()->id]);
});
