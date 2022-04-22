<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions =[
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
       ];
     foreach ($permissions as $permission) {
         Permission::create(['name'=>$permission]);
     
     }
    }
}
