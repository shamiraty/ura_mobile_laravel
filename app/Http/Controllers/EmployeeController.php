<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Post;
use App\Models\District;
use App\Models\User;
class EmployeeController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $posts = Post::all();
        $districts = District::all();

        return view('administration.employee', compact('roles', 'posts', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id||unique:employees,user_id',
            'role_id' => 'required|exists:roles,id',
            'post_id' => 'required|exists:posts,id',
            'district_id' => 'required|exists:districts,id',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|max:15||unique:employees,phone',
            'force_number' => 'required|unique:employees,force_number',
            'rank' => 'required|string|max:50',
        ]);

        try {
            Employee::create($request->all());

            return redirect()->route('employees.create')->with('success', 'Employee added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('employees.create')->with('error', 'Error adding employee: ' . $e->getMessage());
        }
    }
}
