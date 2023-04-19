<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Create a random customer
            'name' => $this->faker->name(),
            'email' => $this->faker->freeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'vat_number' => $this->faker->randomNumber(9),
            'address' => $this->faker->address(),
            'siret' => $this->faker->randomNumber(9),
            'legal_status' => $this->faker->randomElement(['SARL', 'EURL', 'SAS', 'SASU'])
        ];
    }
}
