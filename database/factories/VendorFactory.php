<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


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
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber(15),
            'address' => $this->faker->country(),
            'city'=>$this->faker->city(),
            'state'=>$this->faker->state(),
            'country'=>$this->faker->country(),
            'zipcode'=>123,
            'is_active'=>0,
            'created_by'=>User::all()->random()->id,

        ];
    }
}
