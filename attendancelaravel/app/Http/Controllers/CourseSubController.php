<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Subject;

class CourseSubController extends Controller
{
    public function showForm(Request $request)
    {
        $courses = Course::all();
        $semesters = Semester::all();
        $course_id = $request->input('course_id', 0); 
        $sem_id = $request->input('sem_id', 0); 
        
        return view('reports.coursewise-subreport', compact('courses', 'semesters', 'course_id', 'sem_id'));
    }

    public function generateReport(Request $request)
    {
        $course_id = $request->input('course_id');
        $sem_id = $request->input('sem_id');

        $course_name = Course::find($course_id)->course_name ?? '';
        $name = Semester::find($sem_id)->name ?? '';


        $courses = Course::all();
        $semesters = Semester::all();

        $subjects = Subject::where('course_id', $course_id)
                           ->where('sem_id', $sem_id)
                           ->get();

        return view('reports.coursewise-subreport', compact('courses', 'semesters', 'course_id', 'sem_id', 'course_name', 'name', 'subjects'));
    }
}
