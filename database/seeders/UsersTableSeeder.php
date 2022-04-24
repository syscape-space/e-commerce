<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;
use App\Molels\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()

    {
        
        $user = User::create([
        'name' =>  'Super admin',
        'email' =>  'superAdmin@gmail.com',
        'password' => bcrypt('123456'),
        'email_verified_at'=>NOW(),
        'role' =>  'Superadministrator',
       
    ]);
    $permissions=Permission::pluck('id','id')->all();
    $user->attachRole('superadministrator')->syncPermissions($permissions);

        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'password'=>bcrypt('123456'),
            'email_verified_at'=>NOW(),
            'role'=>'admin'
        ])->attachRole('administrator');

        
        User::create([
            'name'=>'customer',
            'email'=>'customer@gmail.com',
            'password'=>bcrypt('123456'),
            'email_verified_at'=>NOW(),
            'role'=>'customer'
        ])->attachRole('customer');

        // active vendor
        User::create([
            'name'=>'vendor',
            'email'=>'vendor@gmail.com',
            'password'=>bcrypt('123456'),
            'email_verified_at'=>NOW(),
            'role'=>'vendor',
            'as_vendor' => 1,
            'phone' => '0000',
            'adress' => 'Syria',
        ])->attachRole('vendor');

        // not active vendor
        User::create([
            'name'=>'vendor1',
            'email'=>'vendor1@gmail.com',
            'password'=>bcrypt('123456'),
            'email_verified_at'=>NOW(),
            'role'=>'vendor',
            'as_vendor' => 0,
            'phone' => '0000',
            'adress' => 'Syria',
        ]);

    }
}
