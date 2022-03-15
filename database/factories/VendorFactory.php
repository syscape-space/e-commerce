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
<<<<<<< HEAD
            'name'=> $this->faker->unique()->sentence(2),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber(),
            'address'  => $this->faker->country(),
            'city'=>$this->faker->unique()->sentence(2),
            'country'=>$this->faker->unique()->country(2),
           
           
=======
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

>>>>>>> 57d9538bca18c5f0b043b7f23234a99abc220f46
        ];
    }
}
