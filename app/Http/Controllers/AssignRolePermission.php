<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AssignRolePermission extends Controller
{
   public function create($role){

    $role = Role::find($role);
    $permissions = Permission::all();


       return view('backend.pages.permission.addPermission', compact('role', 'permissions'));
   }
}
