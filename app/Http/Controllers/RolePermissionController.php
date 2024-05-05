<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('roles_permission')
            ->where('role_id', $role->id)
            ->pluck('permission_id')
            ->toArray();
        return view('backend.pages.permission.addPermission', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$roleId)
    {
        try {
            // $request->validate([
            //     'permission' => 'required|array',
            // ]);

            // Find the role by its ID
            $role = Role::findOrFail($roleId);
            $role->permissions()->sync($request->permission);

            // Sync permissions to the role
           // $role->permissions()->attach($request->permission);
            return redirect()->route('role')->with('success', 'Permission added to Role successfully.');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
