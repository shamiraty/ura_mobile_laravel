<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonReset;
use App\Models\Payroll;
use Illuminate\Database\QueryException;

//here  are users  who forgot PIN
class PersonResetController extends Controller
{
    public function create()
    {
        // Pass available users to the view to link to the person reset
        return view('applications.reset_user');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'check_number' => 'required|unique:person_resets,check_number', // Check number uniqueness within the PersonReset table
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'simu' => 'required|string|max:15|unique:person_resets,simu',
            'status' => 'nullable|boolean',
        ]);

        // Check if the provided check_number exists in the Payroll table
        $payrollExists = Payroll::where('checkNumber', $request->check_number)->exists();

        if (!$payrollExists) {
            // If the check_number doesn't exist in the Payroll table, return an error
            return redirect()->route('personResets.create')->with('error', 'The check number does not exist in the Payroll table. Please verify the number.');
        }

        try {
            // Handle image upload if there is an image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('person_resets', 'public');
            } else {
                $imagePath = null; // No image uploaded
            }

            // Create the PersonReset record
            PersonReset::create([
                'check_number' => $request->check_number,
                'image' => $imagePath,
                'simu' => $request->simu,
                'status' => $request->status ?? false,  // false will be stored as 0
                'user_id' => auth()->id(),  // Auto-capture the current logged-in user
                'registered_date' => now(),
            ]);

            return redirect()->route('personResets.create')->with('success', 'Record added successfully!');
        } catch (QueryException $e) {
            // Catch duplicate entry or other database errors
            return redirect()->route('personResets.create')->with('error', 'Error adding Record: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Catch any other exceptions
            return redirect()->route('personResets.create')->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
