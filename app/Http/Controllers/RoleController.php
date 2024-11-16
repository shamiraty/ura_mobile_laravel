<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function create()
    {
        return view('administration.role');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|unique:roles,role|max:100', // Ensure role is unique and required
        ]);

        try {
            Role::create([
                'role' => $request->role,
                'registered_date_auto' => now(),
            ]);

            return redirect()->route('roles.create')->with('success', 'Role added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('roles.create')->with('error', 'Error adding role: ' . $e->getMessage());
        }
    }
}
