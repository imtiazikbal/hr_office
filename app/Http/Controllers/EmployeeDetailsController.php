<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDetails;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function employeeDetails(Request $request,$id)
    {
      
        Employee::where('user_id', $id)->update([
            'name' => $request->name,
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
        ]);

        
      //  dd($employee);
        // Employee details create

        EmployeeDetails::updateOrCreate(
            [ 'user_id' => auth()->user()->id], // Conditions to find the record
            [                             // Data to update or create
                'address' => $request->address,
                'phone' => $request->phone,
                'social_fb' => $request->social_fb,
                'social_twitter' => $request->social_twitter,
                'social_linkedin' => $request->social_linkedin 
            ]
        );
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeDetails $employeeDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeDetails $employeeDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeDetails $employeeDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeDetails $employeeDetails)
    {
        //
    }
}
