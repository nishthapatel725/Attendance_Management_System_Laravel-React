<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:teachers-list|teachers-create|teachers-edit|teachers-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:teachers-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:teachers-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:teachers-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $teachers = Teacher::with('designation')->get();
        $designations = Designation::all();
        return view('teachers.index', compact('teachers', 'designations'));
    }

    // public function create()
    // {
    //     $designations = Designation::all();
    //     return view('teachers.create', compact('designations'));
    // }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'u_type' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'date_of_birth' => 'required|date',
            'qualification' => 'required|string|max:255',
            'designation_id' => 'required|exists:designations,id',
            'date_of_joining' => 'required|date',
            'contact' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers,email|unique:users,email',
            'password' => 'required|string',
        ]);
        // dd($request->all());
        try {
            // Create a new user for the teacher
            $user = User::create([
                'u_type' => $validated['u_type'],
                'name' => $validated['first_name'] . ' ' . $validated['middle_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
// dd($validated);
            // Create a new teacher
            Teacher::create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'date_of_birth' => $validated['date_of_birth'],
                'qualification' => $validated['qualification'],
                'designation_id' => $validated['designation_id'],
                'date_of_joining' => $validated['date_of_joining'],
                'contact' => $validated['contact'],
                'email' => $validated['email'],
                'id' => $user->id, // Assign user ID to teacher
            ]);

            return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating teacher: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create teacher.');
        }
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teachers = Teacher::all();
        $designations = Designation::all();
        return view('teachers.index', compact('teacher', 'teachers','designations'));
    }


    public function update(Request $request, $id)
    {
        // Find the teacher by ID
        $teacher = Teacher::findOrFail($id);

        // Find the associated user by email (assuming both tables share the email field)
        $user = User::where('email', $teacher->email)->firstOrFail();

        // Validate the request data
        $validated = $request->validate([
            'u_type' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'date_of_birth' => 'required|date',
            'qualification' => 'required|string|max:255',
            'designation_id' => 'required|exists:designations,id',
            'date_of_joining' => 'required|date',
            'contact' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id . '|unique:users,email,' . $user->id,
            'password' => 'nullable|string', // Password is optional
        ]);

        try {
            // Update the user record
            $user->update([
                'u_type' => $validated['u_type'],
                'name' => $validated['first_name'] . ' ' . ($validated['middle_name'] ?? '') . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
            ]);

            // Update the teacher record
            $teacher->update([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'date_of_birth' => $validated['date_of_birth'],
                'qualification' => $validated['qualification'],
                'designation_id' => $validated['designation_id'],
                'date_of_joining' => $validated['date_of_joining'],
                'contact' => $validated['contact'],
                'email' => $validated['email'],
            ]);

            return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating teacher: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update teacher.');
        }
    }

    public function destroy($id)
{
    try {
        // Find the teacher and user by email
        // $teacher = Teacher::where('email', $email)->firstOrFail();
        // $user = User::where('email', $email)->firstOrFail();
        $teacher = Teacher::findOrFail($id);

        // Find the associated user by email (assuming both tables share the email field)
        $user = User::where('email', $teacher->email)->firstOrFail();

        // Delete the teacher and user records
        $teacher->delete();
        $user->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher and user deleted successfully.');
    } catch (\Exception $e) {
        Log::error('Error deleting teacher and user: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to delete teacher and user.');
    }
}

}
