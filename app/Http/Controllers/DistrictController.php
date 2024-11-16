<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Branch;

class DistrictController extends Controller
{
    public function create()
    {
        $branches = Branch::all(); // Fetch all branches to populate the dropdown
        return view('administration.district', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:districts,name|max:100',
            'branch_id' => 'required|exists:branches,id', // Ensure branch_id references an existing branch
        ]);

        try {
            District::create([
                'name' => $request->name,
                'branch_id' => $request->branch_id,
                'registered_date_auto' => now(),
            ]);

            return redirect()->route('districts.create')->with('success', 'District added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('districts.create')->with('error', 'Error adding district: ' . $e->getMessage());
        }
    }
}
