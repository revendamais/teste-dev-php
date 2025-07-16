<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $formRequest = new Request();
        
        $request = Http::get('https://jsonplaceholder.typicode.com/users');
        //$response = $this->get('https://jsonplaceholder.typicode.com/users');
       
        $this->assertEquals(200, $request->getStatusCode());
        //$response->assertStatus(200);
    }
}
