<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $permissions = Permission::all();
            return view('backend.pages.Permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.Permission.create');
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


        Permission::create(
         [
            'name' => $request->name,
            'slug' => $request->slug
         ]
        );

        return redirect()->route('permission')->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
    
        return view('backend.pages.Permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            "name"=>["required","string","max:255"],
            "slug"=>["required","string","max:255"],
        ]);
        $permission->update(
            [
                'name' => $request->name,
                'slug' => $request->slug
            ]
            );
            return redirect()->route('permission')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
    }
}
