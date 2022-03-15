<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->unique()->sentence(2),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber(),
            'address'  => $this->faker->country(),
            'city'=>$this->faker->unique()->sentence(2),
            'country'=>$this->faker->unique()->country(2),
           
           
        ];
    }
}
