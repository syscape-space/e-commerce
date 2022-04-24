<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\User;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
        \App\Models\User::factory(10)->create();
        \App\Models\Vendor::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\SubCategory::factory(10)->create();
        \App\Models\Product::factory(10)->create();
        \App\Models\Vendor::factory(10)->create();
        */
        $this->Call(LaraTrustSeeder::class);
        $this->Call(PermissionsTableSeeder::class);
        $this->Call(RoleTableSeeder::class);
        $this->Call(UsersTableSeeder::class);
        Category::create([
            'name'=>'laptop ',
            'image'=>'public/images/laptop.jpg',
            'description'=>'laptop category',
        ]);
        Category::create([
            'name'=>'mobile phone',
            'image'=>'public/images/phone.png',
            'description'=>'mobile phone category',
        ]);
        Category::create([
            'name'=>'book',
            'image'=>'public/images/book.jpg',
            'description'=>'book category',
        ]);

     
        SubCategory::create(['name'=>'dell','category_id'=>1]);
        SubCategory::create(['name'=>'hp','category_id'=>1]);
        SubCategory::create(['name'=>'lenovo','category_id'=>1]);
        SubCategory::create(['name'=>'samsung','category_id'=>2]);
        SubCategory::create(['name'=>'sony','category_id'=>2]);
        SubCategory::create(['name'=>'novel','category_id'=>3]);

        Brand::create(['name'=>'ahmad shop','logo'=>'logo.jpg','vendor_id'=>1]);


        Product::create([
            'name'=>'HP LAPTOPS ',
            'image'=>'laptop.jpg',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 1,
            'subCategory_id'=>2,
            'brand_id'=>1,
            'vendor_id'=>4
        ]);

        Product::create([
            'name'=>'Dell LAPTOPS ',
            'image'=>'laptop.jpg',
            'price'=> rand(800,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 1,
            'subCategory_id'=>1,
            'brand_id'=>1,
            'vendor_id'=>4
        ]);

        Product::create([
            'name'=>'LENOVO LAPTOPS ',
            'image'=>'laptop.jpg',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 1,
            'subCategory_id'=>3,
            'brand_id'=>1,
            'vendor_id'=>4
        ]);
        Product::create([
            'name'=>'Origin Book ',
            'image'=>'book.jpg',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 3,
            'subCategory_id'=>6,
            'brand_id'=>1,
            'vendor_id'=>4
        ]);
        Product::create([
            'name'=>'Samsung Mobile Phone ',
            'image'=>'phone.png',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 2,
            'subCategory_id'=>4,
            'brand_id'=>1,
            'vendor_id'=>4
        ]);

    }
    
}
