<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {




    

 
            
     








        Role::insert([
            ['name'=>'Editor','slug'=>'editor'],
            ['name'=>'Author','slug'=>'author'],
            ['name'=>'Admin','slug'=>'admin'],
            ['name'=>'Super-Admin','slug'=>'super-admin'],
        ]);

        Permission::insert([
            ['name'=>'edit-news','slug'=>'edit-news'],
            ['name'=>'delete-news','slug'=>'delete-news'],
            ['name'=>'create-news','slug'=>'create-news'],
            ['name'=>'view-news','slug'=>'view-news'],
        ]);

    }
}
