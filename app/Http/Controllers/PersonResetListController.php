<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PersonReset;
use App\Models\Employee;

class PersonResetListController extends Controller
{
    public function index()
    {
        // Get the current logged-in user
        $user = Auth::user();

        // Fetch the current user's role
        $role = $user->employee->role->role;

        // Fetch the current user's branch (through employee relationship)
        $userBranch = $user->employee->district->branch;

        // Fetch personResets records based on the user role
        if ($role === 'admin') {
            // If the user is an admin, show all records (no branch filter)
            $personResets = PersonReset::all();  // Admin can see all records without filtering by branch
        } elseif ($role === 'tehama') {
            // If the user is 'tehama', fetch records from the same branch as the user
            $personResets = PersonReset::whereHas('user.employee.district.branch', function ($query) use ($userBranch) {
                $query->where('branches.id', $userBranch->id);  // Filter by branch of the logged-in user
            })->get();
        } else {
            // For any other roles, show only records added by the logged-in user
            $personResets = PersonReset::whereHas('user', function ($query) use ($user) {
                $query->where('users.id', $user->id);  // Only show records added by the logged-in user
            })->get();
        }

        // Fetch payroll records that also exist in PersonReset, with fname, mname, lname
        $payrollData = DB::table('payrolls')
            ->leftJoin('person_resets', 'payrolls.checkNumber', '=', 'person_resets.check_number')
            ->select('payrolls.checkNumber', 'payrolls.fname', 'payrolls.mname', 'payrolls.lname', 'person_resets.check_number')
            ->get();

        // Merge the payroll data with the personResets records for display
        foreach ($personResets as $personReset) {
            // Match personReset check_number with the payroll check_number
            $payroll = $payrollData->firstWhere('check_number', $personReset->check_number);
            
            // If a payroll entry is found, attach the name details
            if ($payroll) {
                $personReset->payroll_fname = $payroll->fname;
                $personReset->payroll_mname = $payroll->mname;
                $personReset->payroll_lname = $payroll->lname;
            } else {
                // If no payroll entry is found, set the names to null
                $personReset->payroll_fname = null;
                $personReset->payroll_mname = null;
                $personReset->payroll_lname = null;
            }
        }

        // Return view with the fetched records
        return view('application_list.reset_user_list', compact('personResets'));
    }

    public function toggleStatus($id)
    {
        // Find the personReset record by ID
        $personReset = PersonReset::findOrFail($id);

        // Toggle the status of the record
        $personReset->status = !$personReset->status; // Toggle status
        $personReset->save(); // Save the updated status

        // Redirect back to the index with a success message
        return redirect()->route('personResets.index')->with('success', 'Status updated successfully!');
    }

    public function show($id)
    {
        // Find the personReset record with related user data
        $personReset = PersonReset::with('user')->findOrFail($id);

        // Return the personReset data as JSON
        return response()->json($personReset);
    }

    public function fetchEmployeeDetails($userId)
    {
        // Fetch employee details by user ID with related role, post, and district data
        $employee = Employee::with(['role', 'post', 'district'])
            ->where('user_id', $userId)
            ->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee not found!']);
        }

        // Return employee details as JSON
        return response()->json([
            'user_id' => $employee->user_id,
            'role' => $employee->role->role ?? 'N/A',
            'post' => $employee->post->name ?? 'N/A',
            'district' => $employee->district->name ?? 'N/A',
            'email' => $employee->email,
            'phone' => $employee->phone,
            'force_number' => $employee->force_number,
            'rank' => $employee->rank,
            'registered_date' => $employee->registered_date,
        ]);
    }
}
