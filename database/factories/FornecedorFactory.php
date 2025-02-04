<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory
{
    protected $model = Fornecedor::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->company,
            'tipo' => $this->faker->randomElement(['Física', 'Jurídica']), // Definir opções válidas
            'email' => $this->faker->unique()->safeEmail,
            'documento' => $this->faker->unique()->numerify('###########'), // CPF/CNPJ fictício
            'telefone' => $this->faker->numerify('###########'), // Telefone fictício
            'endereco' => $this->faker->address, // Adicionando um endereço válido
        ];
    }
}
