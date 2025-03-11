<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $course_count = Course::count();
        $sem_count = Semester::count();
        $tea_count = Teacher::count();
        $student_count = Student::where('approval_status', 0)->count();

        return view('dashboard', compact('course_count','sem_count','tea_count','student_count'));
    }
}
