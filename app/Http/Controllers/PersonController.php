<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonNew;
use App\Models\Payroll;
use Illuminate\Database\QueryException;

class PersonController extends Controller
{
    // Show the form to create a new person
    public function create()
    {
        // No need to pass users to the view anymore since we're using the logged-in user
        return view('applications.new_users');
    }

    // Store the newly created person
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'check_number' => 'required|unique:person_news,check_number',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'simu' => 'required|string|max:15',
            'status' => 'nullable|boolean', // The status can be nullable and a boolean
            // Removed user_id from validation as we are capturing it automatically
        ]);

        // Check if the provided check_number exists in the Payroll table
        $payrollExists = Payroll::where('checkNumber', $request->check_number)->exists();

        if (!$payrollExists) {
            // If the check_number doesn't exist in the Payroll table, return an error
            return redirect()->route('persons.create')->with('error', 'The check number does not exist in the Payroll table. Please verify the number.');
        }

        try {
            // Handle image upload if there is an image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('persons', 'public');
            } else {
                $imagePath = null; // No image uploaded
            }

            // Create a new Person record with the provided data
            PersonNew::create([
                'check_number' => $request->check_number,
                'image' => $imagePath,
                'simu' => $request->simu,
                'status' => $request->status ?? false, // Default status to false (inactive) if not provided
                'user_id' => auth()->id(), // Capture the currently logged-in user
                'registered_date' => now(),
            ]);

            return redirect()->route('persons.create')->with('success', 'Person record added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('persons.create')->with('error', 'Error adding person: ' . $e->getMessage());
        }
    }

    // Update the status of a person by check number
    public function updateStatus($check_number)
    {
        // Find the person by their check number
        $person = PersonNew::where('check_number', $check_number)->first();

        // Check if the person exists
        if (!$person) {
            return redirect()->back()->with('error', 'Person not found');
        }

        // Toggle the status between 'active' and 'inactive'
        $person->status = ($person->status == false) ? true : false;

        // Save the updated status
        $person->save();

        // Return with success message
        return redirect()->back()->with('status', 'Status updated successfully!');
    }
}
