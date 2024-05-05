<?php

namespace Database\Seeders;

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
        User::insert([
            ['name'=>'user','email'=>'user11@gmail.com','password'=>bcrypt('password')],
            ['name'=>'Editor','email'=>'editor11@gmail.com','password'=>bcrypt('password')],
            ['name'=>'Author','email'=>'author11@gmail.com','password'=>bcrypt('password')],
        ]);

        Role::insert([
            ['name'=>'Editor','slug'=>'editor'],
            ['name'=>'Author','slug'=>'author'],
        ]);

        Permission::insert([
            ['name'=>'Add Post','slug'=>'add-post'],
            ['name'=>'Delete Post','slug'=>'delete-post'],
        ]);

    }
}
