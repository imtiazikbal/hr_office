<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AssignRolePermissionController extends Controller
{
    public function create($role){

        $role = Role::find($role);
        $permissions = Permission::all();
        
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
           return view('backend.pages.permission.addPermission', compact('role', 'permissions', 'rolePermissions'));
       }

       //give permissions here and Update role

       function store(Request $request, $role){

        $request->validate([
            'permission' => 'required'
        ]);
        $role = Role::find($role);

        $role->permissions()->sync($request->permission);

        return redirect()->route('role')->with('success', 'Permission Assigned Successfully');



       }
}
