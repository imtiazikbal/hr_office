<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class EmployeeProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profilePhoto()
    {
        $profileImage = Employee::where('user_id', auth()->user()->id)->first();
        return $profileImage->image;
        return asset($profileImage->image);
    }

    function profilePhotoUpdate(Request $request){

        $img = $request->file('image');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/profile/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/profile'), $img_name);
        Employee::where('user_id', auth()->user()->id)->update([
            'image' => $imgUrl
        ]);
      
    

    }
    /**
     * Show the form for creating a new resource.
     */
    public function profile()
    {
        $userImage =  Employee::where('user_id', auth()->user()->id)->first();
      
       return view('backend.pages.profile.profile',compact('userImage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getProfileDetails(Request $request)
    {
        $profile =  User::with('employee', 'employeeDetails', 'employee.position', 'employee.department')->where('id', auth()->user()->id)->first();

        return $profile;
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
