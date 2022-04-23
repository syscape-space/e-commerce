<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $superadmin = Role::create([
            'name' =>  'superadministrator',
            'display_name' =>  'super Admin',
            'description' => 'can do anything in the project',
           
           
        ]);
        $admin = Role::create([
            'name' =>  'administrator',
            'display_name' =>  'Admin',
            'description' => 'can create and delete in the project',
           
           
        ]);
        $user= Role::create([
            'name' =>  'customer',
            'display_name' =>  'customer',
            'description' => 'can do specific tasks  in the project',
           
           
        ]);
        $user= Role::create([
            'name' =>  'vendor',
            'display_name' =>  'vendor',
            'description' => 'can do specific tasks  in the project',
           
           
        ]);
    }
}
