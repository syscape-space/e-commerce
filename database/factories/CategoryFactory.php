<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
            'image'=>'https://via.placeholder.com/350x150',
            'description'=> $this->faker->realText(rand(30, 60)),
        ];
    }
}
