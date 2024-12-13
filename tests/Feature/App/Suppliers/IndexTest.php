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
             ->assertJsonCount(3, 'data')
             ->assertJsonFragment(['id' => $suppliers->first()->id]);
});
