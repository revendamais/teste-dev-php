<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'registration_number' => $this->faker->unique()->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
    
    public function withAddress()
    {
        return $this->afterCreating(function (Supplier $supplier) {
            Address::factory()->create([
                'supplier_id' => $supplier->id,
            ]);
        });
    }
}
