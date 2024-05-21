<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
    public function index()
    {
        return view('admin.employees');
    }


    public function alldata()
    {
        $employees = Employees::all();
        return view('admin.employees')->with('employee', $employees);
    }

    public function add_employees()
    {
        return view('admin.addEmployees');
    }

    public function store(Request $request)
    {
        $employee = new Employees;

        $employee->employee_id = $request->input('employee_id');
        $employee->first_name = $request->input('firstname');
        $employee->last_name = $request->input('lastname');
        $employee->job_title = $request->input('job_title');
        $employee->department = $request->input('department');
        $employee->phone = $request->input('phone');
        $employee->email = $request->input('email');

        $employee->birth_date = $request->input('birthday');

        //$employee->image = $request->file('image')->getSize();

        //saving employee image to the storage and tne save the name in the database
        $image_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images/', $image_name);
        $employee->image = $image_name;

        //return $employee;

        $employee->save();

        return redirect('/employees')->with('status', 'Your data has been Save');
    }

    public function employeesedit(Request $request, $id)
    {

        $employee = employees::findOrFail($id);
        return view('admin.employee-edit')->with('employee', $employee);
    }

    public function employeeupdate(Request $request, $id)
    {

        $employee = employees::find($id);
        $employee->first_name = $request->input('firstname');
        $employee->last_name = $request->input('lastname');
        $employee->job_title = $request->input('job_title');
        $employee->department = $request->input('department');
        $employee->phone = $request->input('phone');
        $employee->email = $request->input('email');

        $employee->birth_date = $request->input('birthday');
        $employee->update();

        return redirect('/employees')->with('status', 'Your data has been Updated');
    }

    public function employeedelete(Request $request)
    {

        $employee = employees::findOrFail($request->delete_user);

        // Assuming $employee is your employee model instance
        $imageName = $employee->image; // Assuming the image name is stored in the 'image' column

        // Delete the image from storage
        Storage::delete('storage/images/' . $imageName); // Adjust the path as per your storage configuration

        $employee->delete();

        return redirect('/employees')->with('status', 'Your data has been Deleted');
    }

    // public function count()
    // {
    //     // Retrieve the count of employees
    //     $employeeCount = employees::count();

    //     // Pass the count to the view
    //     return view('admin.dashboard', ['employeeCount' => $employeeCount]);
    // }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $searchResults = Employees::where('first_name', 'LIKE', "%$search%")
            ->orWhere('last_name', 'LIKE', "%$search%")
            ->orWhere('employee_id', $search)
            ->get();

        return view('admin.employeesearch')->with('searchResults', $searchResults);
    }

    public function showEmployeeDetails(Request $request)
    {
        $user_id = $request->input('user_id');

        // Fetch employee details from the database
        $employee = Employees::find($user_id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Return the employee details as JSON response
        return response()->json([
            'employee_id' => $employee->employee_id,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'job_title' => $employee->job_title,
            'department' => $employee->department,
            'phone' => $employee->phone,
            'email' => $employee->email,
            'birth_date' => $employee->birth_date,
        ]);
    }
}
