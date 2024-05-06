<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
      //  return $roles;
       
       return view('backend.pages.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>["required","string","max:255"],
            "slug"=>["required","string","max:255"],
        ]);


        Role::create(
         [
            'name' => $request->name,
            'slug' => $request->slug
         ]
        );

        return redirect()->route('role')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
       return view('backend.pages.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            "name"=>["required","string","max:255"],
            "slug"=>["required","string","max:255"],
        ]);
        $role->update(
            [
                'name' => $request->name,
                'slug' => $request->slug
            ]
            );
            return redirect()->route('role')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
       

     }
}
