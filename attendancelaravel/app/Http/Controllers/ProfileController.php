<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function show()
    {
        // Fetch the logged-in user's data (adjust according to your setup)
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // public function update(Request $request)
    // {
    //     // Validate the input
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'middle_name' => 'nullable|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'date_of_birth' => 'required|date',
    //         'txt_contact' => 'required|string|max:15',
    //         'email' => 'required|email|max:255',
    //         'old_password' => 'nullable|string', // For checking old password if needed
    //         'password' => 'nullable|string|confirmed|min:8', // Ensure confirmation matches and minimum length
    //     ]);

    //     $user = Auth::user();

    //     // Check if old password matches (if applicable)
    //     if ($request->filled('old_password') && !Hash::check($request->old_password, $user->password)) {
    //         return back()->withErrors(['old_password' => 'Old password is incorrect.']);
    //     }

    //     // Update user details
    //     $user->first_name = $request->first_name;
    //     $user->middle_name = $request->middle_name;
    //     $user->last_name = $request->last_name;
    //     $user->date_of_birth = $request->date_of_birth;
    //     $user->contact = $request->txt_contact; // Fixed typo: changed contact to txt_contact
    //     $user->email = $request->email;

    //     // Update password if provided
    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->password); // Use Hash::make for security
    //     }

    //     $user->save(); // Save user details

    //     // Optionally, update teacher data if applicable
    //     if ($user->role === 'teacher') {
    //         // Get the related Teacher record
    //         $teacher = Teacher::where('user_id', $user->id)->first();

    //         // Make sure the teacher record exists before attempting to update
    //         if ($teacher) {
    //             // Update teacher-specific fields if necessary
    //             // Example: $teacher->some_field = $request->input('some_field');
    //             // Uncomment and update this line with actual fields

    //             $teacher->save(); // Save teacher if updates were made
    //         } else {
    //             // If no Teacher record exists, you might want to create one or handle the case accordingly
    //             // Uncomment the line below to create a new Teacher record
    //             // Teacher::create(['user_id' => $user->id, /* other fields */]);

    //             return back()->withErrors(['teacher' => 'Teacher record not found.']);
    //         }
    //     }

    //     return redirect()->back()->with('alert_msg', 'Profile updated successfully.');
    // }
}
