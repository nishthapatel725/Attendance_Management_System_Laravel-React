<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function showRegistrationForm()
    {
        $student = Student::with(['course', 'semester'])->get();
        $courses = Course::all();
        $semesters = Semester::all();
        return view('s_register', compact('courses', 'semesters'));
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'contact' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required',
            'gr_no' => 'required|string|max:20|unique:students',
            'enrollment_no' => 'required|string|max:20|unique:students',
            'course_id' => 'required|exists:courses,course_id',
            'sem_id' => 'required|exists:semesters,sem_id',
        ]);

        $student = new Student();
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->contact = $request->contact;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->gr_no = $request->gr_no;
        $student->enrollment_no = $request->enrollment_no;
        $student->course_id = $request->course_id;
        $student->sem_id = $request->sem_id;
        // dd($student);
        $student->save();

        // dd($request->all());

        return redirect('/')->with('success', 'Registration successful! Please log in.');
    }
}
