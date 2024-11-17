<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Show the user profile page.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Fetch the associated employee record
        $employee = $user->employee;

        // Pass data to the view
        return view('profile.edit_custom', compact('user', 'employee'));
    }

    /**
     * Update the user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        // Get the currently authenticated user
        $user = auth()->user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match our records.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect to profile with success message
        return redirect()->route('profile')->with('success', 'Password updated successfully!');
    }
}
