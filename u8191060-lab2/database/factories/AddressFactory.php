<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{

    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'title' => $this->faker->word(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetAddress(),
            'house' => (string)rand(0, 100),
            'floor' => rand(1, 20),
            'apartment' => rand(1, 200),
            'intercom_code' => rand(1000, 9999),
        ];
    }
}
