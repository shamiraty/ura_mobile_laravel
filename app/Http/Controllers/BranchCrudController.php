<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchCrudController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        dd($branches);
        return view('administration.branch', compact('branches'));
    }

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
            return redirect()->route('branches.index2')->with('success', 'Branch added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('branches.index2')->with('error', 'Error adding branch: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:branches,id',
            'name' => 'required|max:100|unique:branches,name,' . $request->id,
        ]);

        try {
            $branch = Branch::findOrFail($request->id);
            $branch->update(['name' => $request->name]);

            return response()->json(['success' => 'Branch updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating branch: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|exists:branches,id']);

        try {
            $branch = Branch::findOrFail($request->id);
            $branch->delete();

            return response()->json(['success' => 'Branch deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting branch: ' . $e->getMessage()], 500);
        }
    }
}
