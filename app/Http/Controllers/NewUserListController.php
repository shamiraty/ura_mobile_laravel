<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Use to get the current authenticated user
use Illuminate\Support\Facades\DB;
use App\Models\PersonNew;
use App\Models\Employee;
use App\Models\Branch;  // Add this to get the Branch model

class NewUserListController extends Controller
{
    public function index()
    {
        // Get the current logged-in user
        $user = Auth::user();

        // Fetch the current user's role
        $role = $user->employee->role->role;

        // Fetch the current user's branch (through employee relationship)
        $userBranch = $user->employee->district->branch;

        if ($role === 'admin') {
            // If the user is an admin, show all records (no branch filter)
            $persons = DB::table('person_news')
                ->join('users', 'person_news.user_id', '=', 'users.id')
                ->select('person_news.*', 'users.name as added_by')
                ->get();  // Admin can see all records without filtering by branch
        } elseif ($role === 'tehama') {
            // If the user is 'tehama', fetch records from the same branch as the user
            $persons = DB::table('person_news')
                ->join('users', 'person_news.user_id', '=', 'users.id')
                ->join('employees', 'employees.user_id', '=', 'users.id')
                ->join('districts', 'districts.id', '=', 'employees.district_id')
                ->join('branches', 'branches.id', '=', 'districts.branch_id')
                ->where('branches.id', $userBranch->id)  // Filter by branch of the logged-in user
                ->select('person_news.*', 'users.name as added_by')
                ->get();
        } else {
            // For any other roles, show only records added by the logged-in user
            $persons = DB::table('person_news')
                ->join('users', 'person_news.user_id', '=', 'users.id')
                ->where('users.id', $user->id)
                ->select('person_news.*', 'users.name as added_by')
                ->get();
        }

        // Return view with the fetched records
        return view('application_list.new_user_list', compact('persons'));
    }

    public function toggleStatus($id)
    {
        $person = DB::table('person_news')->where('id', $id)->first();

        if ($person) {
            $status = !$person->status; // Toggle status
            DB::table('person_news')->where('id', $id)->update(['status' => $status]);

            return redirect()->route('persons.index')->with('success', 'Status updated successfully!');
        }

        return redirect()->route('persons.index')->with('error', 'Person not found!');
    }

    public function show($id)
    {
        // Fetch the person data with user info and payroll
        $person = PersonNew::with('user', 'payroll')->findOrFail($id);

        return response()->json($person);
    }

    public function fetchEmployeeDetails($userId)
    {
        $employee = Employee::with(['role', 'post', 'district'])
            ->where('user_id', $userId)
            ->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee not found!']);
        }

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
