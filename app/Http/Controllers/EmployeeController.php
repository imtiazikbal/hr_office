<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EmployeeDetails;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['position', 'department', 'user', 'user.roles'])
            ->orderBy('id', 'desc')
            ->get();
           // return $employees;
        return view('backend.pages.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();

        $roles = Role::all();
        return view('backend.pages.employee.add', compact('departments', 'positions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'username' => ['required', 'string', 'max:255'],
                'emp_id' => ['required', 'string', 'max:255'],
                'date_of_joining' => ['required', 'date_format:Y-m-d'],
                'image' => ['required', 'mimes:png,jpg,jpeg,gif,svg,webp', 'max:2048'],
                'department_id' => ['required'],
                'position_id' => ['required'],
                
            ]);

            // Handle image upload
            $img = $request->file('image');

            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $imgUrl = "uploads/profile/{$img_name}";

            // Upload File
            $img->move(public_path('uploads/profile'), $img_name);

            // Create User
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->roles()->attach($request->role);

            // Create Employee
            Employee::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'username' => $validatedData['username'],
                'emp_id' => $validatedData['emp_id'],
                'date_of_joining' => $validatedData['date_of_joining'],
                'status' => $request->status, // Consider default value if not provided in the request
                'department_id' => $validatedData['department_id'],
                'position_id' => $validatedData['position_id'],
                'image' => $imgUrl,
                'user_id' => $user->id,
            ]);

            return redirect('/employee')->with('success', 'Employee created successfully');
        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => 'An error occurred while processing the request.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$employee = Employee::where('id', $employee->id)->with(['position', 'department', 'user'])->first();
        $user =  User::with('employee', 'employee.position', 'employee.department')->where('id', $id)->first();
        $userDetails = EmployeeDetails::where('user_id', $id)->first();
   // return $userDetails;
    return view('backend.pages.employee.profile', compact('user','userDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::where('id', $employee->id)
            ->with('position', 'department', 'user')
            ->first();

        $departments = Department::all();
        $positions = Position::all();
        $roles = Role::all();
        $userRoles = $employee->user->roles->pluck('id')->toArray();
        return view('backend.pages.employee.edit', compact('employee', 'departments', 'positions','roles','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employee->id),
                Rule::unique('users', 'email')->ignore($employee->user->id),
            ],
            
            'username' => ['required', 'string', 'max:255'],
            'emp_id' => ['required', 'string', 'max:255'],
            'date_of_joining' => ['required', 'date_format:Y-m-d'],

            'department_id' => ['required'],
            'position_id' => ['required'],
           
        ]);

        if ($request->hasFile('image')) {
            // Handle image upload
            $img = $request->file('image');

            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $imgUrl = "uploads/profile/{$img_name}";

            // Upload File
            $img->move(public_path('uploads/profile'), $img_name);

            // Create User
            $userData = [
                'name' => $validatedData['name'],
                'email' => $request->email ? $validatedData['email'] : $employee->email,
                'password' => $request->password ? Hash::make($validatedData['password']) : $employee->password,
         
            ];

            $user = User::where('id', $employee->user_id)->update($userData);
       
            $user->roles()->attach($request->role);

            // Create Employee
            $employee->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' =>  $employee->password,
                'username' => $validatedData['username'],
                'emp_id' => $validatedData['emp_id'],
                'date_of_joining' => $validatedData['date_of_joining'],
                'status' => $request->status, // Consider default value if not provided in the request
                'department_id' => $validatedData['department_id'],
                'position_id' => $validatedData['position_id'],
                'image' => $imgUrl,
                'user_id' => $employee->user_id,
            ]);

            return redirect('/employee')->with('success', 'Employee updated successfully');
        } else {
            $userData = [
                'name' => $validatedData['name'],
                'email' => $request->email ? $validatedData['email'] : $employee->email,
                'password' =>  $employee->password,
              
            ];

            User::where('id', $employee->user_id)->update($userData);
            $user = User::find($employee->user_id);
     
            $user->roles()->sync($request->role);


            $employee->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $request->password ? Hash::make($validatedData['password']) : $employee->password,
                'username' => $validatedData['username'],
                'emp_id' => $validatedData['emp_id'],
                'date_of_joining' => $validatedData['date_of_joining'],
                'status' => $request->status, // Consider default value if not provided in the request
                'department_id' => $validatedData['department_id'],
                'position_id' => $validatedData['position_id'],
                'image' => $employee->image,
                'user_id' => $employee->user_id,
            ]);

            return redirect('/employee')->with('success', 'Employee updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        File::delete($employee->image);
        $employee->delete();

    }
}
