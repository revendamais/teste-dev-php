<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FornecedorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_listar_fornecedores()
    {
        Fornecedor::factory()->count(3)->create();

        $response = $this->getJson('/api/fornecedores');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_criar_fornecedor()
    {
        $dados = [
            'tipo_documento' => 'CNPJ',
            'documento' => '19131243000197',
            'nome' => 'Fornecedor Teste',
            'contato' => 'João da Silva',
            'email' => 'teste@fornecedor.com',
            'endereco' => 'Rua das Flores, 123, Bairro Centro, Cidade X',
        ];

        $response = $this->postJson('/api/fornecedores', $dados);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                    'nome' => 'Fornecedor Teste',
                    'documento' => '19131243000197',
                 ]);

        $this->assertDatabaseHas('fornecedores', [
            'documento' => '19131243000197',
        ]);
    }

    

    public function test_mostrar_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->getJson("/api/fornecedores/{$fornecedor->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                    'id' => $fornecedor->id,
                    'nome' => $fornecedor->nome,
                 ]);
    }

    public function test_atualizar_fornecedor()
{
    $fornecedor = Fornecedor::factory()->create([
        'documento' => '12345678000199',
    ]);

    $dadosAtualizados = [
        'tipo_documento' => $fornecedor->tipo_documento,
        'documento' => '98765432000188', // documento diferente do original para evitar conflito
        'nome' => 'Nome Atualizado',
        'contato' => $fornecedor->contato,
        'email' => $fornecedor->email,
        'endereco' => $fornecedor->endereco,
    ];

    $response = $this->putJson("/api/fornecedores/{$fornecedor->id}", $dadosAtualizados);

    $response->assertStatus(200)
             ->assertJsonFragment([
                'nome' => 'Nome Atualizado',
             ]);

    $this->assertDatabaseHas('fornecedores', [
        'id' => $fornecedor->id,
        'nome' => 'Nome Atualizado',
        'documento' => '98765432000188',
    ]);
}


    public function test_deletar_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->deleteJson("/api/fornecedores/{$fornecedor->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Fornecedor deletado com sucesso.'
                 ]);

        $this->assertDatabaseMissing('fornecedores', [
            'id' => $fornecedor->id,
        ]);
    }
}
