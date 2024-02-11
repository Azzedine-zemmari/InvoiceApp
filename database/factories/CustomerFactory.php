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
            'firstname'=> $this->faker->name,
            'lastname'=>$this->faker->lastName,
            'email'=>$this->faker->email,
            'adress'=>$this->faker->address

        ];
    }
}
