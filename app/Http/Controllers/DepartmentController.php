<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('backend.pages.department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,Department $department)
    {
      // dd($request->all());
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
            ]);
            Department::create([
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status
            ]);
            return response('success', 200);
            }catch(Exception $e){
            return response('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
          
    {
        return Department::all();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return $department;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        try{
           
            $department->update([
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status
            ]);
            return response('success', 200);
            }catch(Exception $e){
            return response('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
       
       $department->delete();
       return response()->json([
           'message' => 'success'

       ]);
    }
}
