<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Semester;
use App\Models\SubAllotment;
use Illuminate\Http\Request;

class SemlistSuballotController extends Controller
{
    public function reports()
    {
        $courses = Course::all();
        $semesters = Semester::all();

        return view('reports.semlist-suballot', compact('courses', 'semesters'));
    }

    public function generate(Request $request)
    {
        $course_id = $request->input('course_id');
        $sem_id = $request->input('sem_id');
        $academic_year = $request->input('acadamic_year');

        $course_name = Course::find($course_id)->course_name ?? '';
        $name = Semester::find($sem_id)->name ?? '';

        $subAllotments = SubAllotment::where('course_id', $course_id)
            ->where('sem_id', $sem_id)
            ->where('academic_year', $academic_year)
            ->with('subject', 'teacher')
            ->get();

        return view('reports.semlist-suballot', compact(
            'course_id', 'sem_id', 'academic_year', 'course_name', 'name', 'subAllotments'
        ))->with([
            'courses' => Course::all(),
            'semesters' => Semester::all()
        ]);
    }
}
