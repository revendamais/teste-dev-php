<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::table('fornecedores')->truncate();
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

        /**
     * Test creating an fornecedor
     */
    public function test_store_fornecedor()
    {
        $data = [
            "nome" => "John Doe",
            "contato" => "Adm",
            "tipo" => "Física",
            "documento" => "222.222.222-22",
            "email" => "fornecedor@test.com.br",
            "telefone" => "(19) 99222-3344",
            "endereco" => "Av Brasil, 2025 - Americana SP"
        ];

        $response = $this->postJson('/api/fornecedor', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'nome' => 'John Doe',
                'email' => 'fornecedor@test.com.br'
            ]);
    }

    /**
     * Test updating an fornecedor
     */
    public function test_update_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create([
            'nome' => 'Fornecedor Antigo',
            'email' => 'antigo@email.com',
            "tipo" => "Física",
            "documento" => "222.222.222-22",
            "telefone" => "(19) 99222-3344",
            "endereco" => "Av Brasil, 2025 - Americana SP"
        ]);

        $dados = [
            'nome' => 'Fornecedor Atualizado',
            'email' => 'atualizado@email.com',
            "tipo" => "Física",
            "documento" => "222.222.222-22",
            "telefone" => "(19) 99222-3344",
            "endereco" => "Av Brasil, 2025 - Americana SP"
        ];


        $response = $this->putJson("/api/fornecedor/{$fornecedor->id}", $dados);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id' => $fornecedor->id,
                'nome' => 'Fornecedor Atualizado',
                'email' => 'atualizado@email.com',
                "tipo" => "Física",
                "documento" => "222.222.222-22",
                "telefone" => "(19) 99222-3344",
                "endereco" => "Av Brasil, 2025 - Americana SP"
            ]);
    }

    /**
     * Test retrieving an fornecedor
     */
    public function test_index_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->getJson("/api/fornecedor/{$fornecedor->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "nome" => $fornecedor->nome,
                "contato" => $fornecedor->contato,
                "email" => $fornecedor->email,
                "tipo" => $fornecedor->tipo,
                "documento" => $fornecedor->documento,
                "telefone" => $fornecedor->telefone,
                "endereco" => $fornecedor->endereco,
            ]);
    }

    /**
     * Test deleting an fornecedor
     */
    public function test_destroy_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->deleteJson("/api/fornecedor/{$fornecedor->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id]);
    }

    /**
     * Test creating an fornecedor with validation failure
     */
    public function test_store_fornecedor_validation()
    {
        $response = $this->postJson('/api/fornecedor', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertJsonStructure([
                    'errors' => [
                        'nome',
                        'email'
                    ]
                ]);
    }
}
