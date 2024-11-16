<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function create()
    {
        return view('administration.branch');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:branches,name|max:100',
        ]);

        try {
            Branch::create([
                'name' => $request->name,
            ]);

            return redirect()->route('branches.create')->with('success', 'Branch added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('branches.create')->with('error', 'Error adding branch: ' . $e->getMessage());
        }
    }
}
