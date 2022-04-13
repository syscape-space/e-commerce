<?php

namespace Database\Seeders;
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




        Product::create([
            'name'=>'HP LAPTOPS ',
            'image'=>'laptop.jpg',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 1,
            'subCategory_id'=>2,
            'vendor_id'=>1
        ]);

        Product::create([
            'name'=>'Dell LAPTOPS ',
            'image'=>'laptop.jpg',
            'price'=> rand(800,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 1,
            'subCategory_id'=>1,
            'vendor_id'=>1
        ]);

        Product::create([
            'name'=>'LENOVO LAPTOPS ',
            'image'=>'laptop.jpg',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 1,
            'subCategory_id'=>3,
            'vendor_id'=>1
        ]);
        Product::create([
            'name'=>'Origin Book ',
            'image'=>'book.jpg',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 3,
            'subCategory_id'=>6,
            'vendor_id'=>1
        ]);
        Product::create([
            'name'=>'Samsung Mobile Phone ',
            'image'=>'phone.png',
            'price'=> rand(700,1000),
            'description'=>'This is the description of a product',
            'category_id'=> 2,
            'subCategory_id'=>4,
            'vendor_id'=>1
        ]);
        Vendor::create([
            'name'=>'vendor1 ',
            'email'=>'vendor1@gmail.com',
            'phone_number'=> '6666',
            'is_active'=>1,
        ]);
       
           User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123456'),
            'email_verified_at'=>NOW(),
            'address'=>'Syria',
            'phone'=>'0000',
            'role'=>'admin'
        ])->attachRole('administrator')->attachPermission('users-create');

        User::create([
            'name'=>'vendor',
            'email'=>'vendor@gmail.com',
            'password'=>bcrypt('123456'),
            'email_verified_at'=>NOW(),
            'address'=>'Syria',
            'phone'=>'0000',
            'role'=>'vendor'
        ])->attachRole('vendor')->attachPermission('categories-create');
        
        User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('123456'),
            'email_verified_at'=>NOW(),
            'address'=>'Syria',
            'phone'=>'0000',
            'role'=>'user'
        ])->attachRole('user');

        
    }
    
}
