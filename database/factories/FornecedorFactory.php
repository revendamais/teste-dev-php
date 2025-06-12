<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory
{
    protected $model = Fornecedor::class;

    public function definition()
    {
        return [
            'tipo_documento' => $this->faker->randomElement(['CPF', 'CNPJ']),
            'documento' => $this->faker->unique()->numerify('###########'), // 11 ou 14 dígitos
            'nome' => $this->faker->company,
            'telefone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'endereco' => $this->faker->address,
        ];
    }
}
