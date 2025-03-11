<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function users(){
        $user = User::all();
        return response()->json([
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $email = $request->query('email');
        $password = $request->query('password');

        // Find user by email
        $user = User::where('email', $email)->first();

        // Check if the user exists and if the password matches the hash
        if ($user && Hash::check($password, $user->password)) {
            // Generate a token or start a session
            $token = Str::random(60);

            $designationName = null;
            $teacherId = null; // Variable to store teacher_id

            // If u_type is 0, use a join query to fetch the designation name and teacher_id
            if ($user->u_type == 0) {
                // Join the teachers and designations tables to get the designation name and teacher_id
                $teacher = Teacher::join('designations', 'teachers.designation_id', '=', 'designations.id')
                    ->where('teachers.email', $user->email) // Matching the user's email in teachers table
                    ->select('designations.name as designation_name', 'teachers.id as teacher_id', 'teachers.email as teacher_email') // Fetch the designation name and teacher_id
                    ->first(); // Get the first matching record

                if ($teacher) {
                    $designationName = $teacher->designation_name; // Assign the designation name
                    $teacherId = $teacher->teacher_id; // Assign the teacher_id
                    $teacheremail = $teacher->teacher_email;
                } else {
                    $designationName = 'Designation not found';
                }
            }

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
                'designationName' => $designationName,
                'teacherId' => $teacherId
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }

    }

}
