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
        'address'=>'Syria',
        'phone'=>'0000',
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
            'address'=>'Syria',
            'phone'=>'0000',
            'role'=>'admin'
        ])->attachRole('administrator');

        
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
