<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "company" => $this->faker->unique()->company(),
            "cnpjcpf" => $this->faker->unique()->numerify('##############'),
            "phone" => $this->faker->unique()->phoneNumber(),
            "email" => $this->faker->unique()->safeEmail(),
            "address" => $this->faker->address(),
        ];
    }
}
