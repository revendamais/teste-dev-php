<?php

namespace Tests\Feature;

use App\Services\CnpjServiceInterface;
use Tests\TestCase;
use Mockery;
use App\Models\User;

class CnpjTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_show_returns_data_for_valid_cnpj()
    {        
        $mockCnpjService = Mockery::mock(CnpjServiceInterface::class);

        $mockCnpjService->shouldReceive('getCnpjData')
            ->with('12345678000195') // CNPJ válido para o teste
            ->once()
            ->andReturn([
                'data' => ['cnpj' => '12345678000195', 'name' => 'Empresa Exemplo'],
                'status_code' => 200
            ]);
        
        $this->app->instance(CnpjServiceInterface::class, $mockCnpjService);
        
        $response = $this->get(route('cnpj.show', ['cnpj' => '12345678000195']));        
        $response->assertStatus(200);
        
        $response->assertJson([
            'cnpj' => '12345678000195',
            'name' => 'Empresa Exemplo'
        ]);
    }

    public function test_show_returns_error_for_invalid_cnpj()
    {        
        $mockCnpjService = Mockery::mock(CnpjServiceInterface::class);

        $mockCnpjService->shouldReceive('getCnpjData')
            ->with('00000000000000') // CNPJ inválido para o teste
            ->once()
            ->andReturn([
                'data' => ['message' => 'CNPJ não encontrado'],
                'status_code' => 404
            ]);
        
        $this->app->instance(CnpjServiceInterface::class, $mockCnpjService);
        
        $response = $this->get(route('cnpj.show', ['cnpj' => '00000000000000']));        
        $response->assertStatus(404);
                
        $response->assertJson([
            'message' => 'CNPJ não encontrado'
        ]);
    }
}
