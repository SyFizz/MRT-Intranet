<?php

namespace Database\Factories;

use App\Models\Customer;
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

        $supportPin = rand(10000000, 99999999);
        while (Customer::where('support_pin', $supportPin)->exists()) {
            $supportPin = rand(10000000, 99999999);
        }

        return [
            //Create a random customer
            'name' => $this->faker->name(),
            'email' => $this->faker->freeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'vat_number' => $this->faker->randomNumber(9),
            'address' => $this->faker->address(),
            'siret' => $this->faker->randomNumber(9),
            'legal_status' => $this->faker->randomElement(['SARL', 'EURL', 'SAS', 'SASU']),
            'support_pin' => $supportPin
        ];
    }
}
