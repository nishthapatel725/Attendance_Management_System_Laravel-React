<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;


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
    //     // Get the currently authenticated teacher
    //     $teacher = Auth::guard('api')->user();

    //     // Ensure the teacher is authenticated and is an instance of the Teacher model
    //     if (!$teacher || !($teacher instanceof Teacher)) {
    //         return response()->json([
    //             'message' => 'Unauthorized'
    //         ], 401);
    //     }

    //     // Validation rules
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required|string|max:255',
    //         'middle_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'date_of_birth' => 'required|date',
    //         'contact' => 'required|string|max:15',
    //         'email' => 'required|email|unique:teachers,email,' . $teacher->id,
    //         'oldPassword' => 'required|string',
    //         'password' => 'nullable|string|confirmed|min:8',
    //     ]);

    //     // If validation fails, return errors
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validation Error',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     // Check if the old password matches the current password
    //     if (!Hash::check($request->oldPassword, $teacher->password)) {
    //         return response()->json([
    //             'message' => 'The old password is incorrect.'
    //         ], 400);
    //     }

    //     // Update the teacher's profile information
    //     $teacher->first_name = $request->first_name;
    //     $teacher->middle_name = $request->middle_name;
    //     $teacher->last_name = $request->last_name;
    //     $teacher->date_of_birth = $request->date_of_birth;
    //     $teacher->contact = $request->contact;
    //     $teacher->email = $request->email;

    //     // If a new password is provided, hash and update it
    //     if ($request->filled('password')) {
    //         $teacher->password = Hash::make($request->password);
    //     }

    //     // Save the updated teacher data
    //     if ($teacher->save()) {
    //         return response()->json([
    //             'message' => 'Profile updated successfully!',
    //             'teacher' => $teacher
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'message' => 'Profile update failed.'
    //         ], 500);
    //     }
    // }
    public function update($email, Request $request)
{
    // Find the user by email
    $user = User::where('email', $email)->first();

    // Check if the user exists
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Compare the password using Hash::check
    if (!Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Incorrect password'], 403);
    }

    // Update teacher and user data if password matches
    $teacher = Teacher::where('email', $email)->first();
    if ($teacher) {
        $teacher->first_name = $request->first_name;
        $teacher->middle_name = $request->middle_name;
        $teacher->last_name = $request->last_name;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->contact = $request->contact;
        $teacher->email = $request->email;  // Update email if needed
        $teacher->save();
    }

    // Update user data
    $user->name = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
    $user->email = $request->email;  // Update email if needed
    $user->save();

    // Return a success response
    return response()->json(['message' => 'Teacher and User updated successfully'], 200);
}

    public function teachers($email)
{
    // Fetch specific columns for the teacher with the given ID
    $teacher = Teacher::join('users', 'teachers.email', '=', 'users.email')
        ->where('teachers.email', $email) // Filter by the teacher ID
        ->select(
            'teachers.first_name',
            'teachers.middle_name',
            'teachers.last_name',
            'teachers.date_of_birth',
            'teachers.contact',
            'teachers.email',
            'users.password' // Assuming users table has the password field
        )
        ->first(); // Use first() to get a single record

    // Check if the teacher is found
    if ($teacher) {
        return response()->json($teacher, 200);
    } else {
        return response()->json(['message' => 'Teacher not found'], 404);
    }
}
}
