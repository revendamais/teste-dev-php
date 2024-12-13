<?php

/**
* This return a suppliers list
*/
it('it should return suppliers list', function () {
    // arrange
    $suppliers = Supplier::factory()->count(3)->create();
    // act
    $response = $this->getJson(route('suppliers.index'));
    // assert
    $response->assertOk()
             ->assertJsonCount(3, 'data')
             ->assertJsonFragment(['id' => $suppliers->first()->id]);
});
