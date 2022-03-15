<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category; 
use App\Models\SubCategory;
use App\Models\Vendor; 


class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->sentence(2),
            'image'=>'https://via.placeholder.com/350x150',
            'description'=> $this->faker->realText(rand(30, 60)),
            'vendor_id'=>Vendor::all()->random()->id,
            'categories_id'=> Category::all()->random()->id,
            'sub_categories_id'=> SubCategory::all()->random()->id,

            'price'=>rand(10,500),
        ];
    }
}
