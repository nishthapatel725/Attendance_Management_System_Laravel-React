<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class SemwiseStudController extends Controller
{
    public function reports()
    {
        $courses = Course::all();
        $semesters = Semester::all();
        return view('reports.semwise-studentdetail', compact('courses', 'semesters'));
    }

    public function generate(Request $request)
    {
        $course_id = $request->input('course_id');
        $sem_id = $request->input('sem_id');
    
        // Retrieve course and semester names
        $course_name = Course::find($course_id)->course_name ?? '';
        $name = Semester::find($sem_id)->name ?? '';
    
        // Fetch all courses and semesters
        $courses = Course::all();
        $semesters = Semester::all();
    
        // Query to get students, including roll number
        $students = DB::table('students')
            ->select('id', 'first_name', 'middle_name', 'last_name', 'roll_no') // Added 'roll_no'
            ->where('course_id', $course_id)
            ->where('sem_id', $sem_id)
            ->where('approval_status', 1)
            ->orderBy('roll_no')
            // ->orderBy('first_name')
            // ->orderBy('middle_name')
            ->get();
    
        return view('reports.semwise-studentdetail', compact('course_id', 'sem_id', 'courses', 'semesters', 'course_name', 'name', 'students'));
    }
    
}