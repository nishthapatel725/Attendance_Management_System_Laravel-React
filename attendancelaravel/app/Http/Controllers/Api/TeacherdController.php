<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Semester;
use App\Models\SubAllotment;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherdController extends Controller
{
    public function index($teacherId)
    {
        //$teacherId = auth()->user()->id; // Get the logged-in teacher's ID

        $allocations = DB::table('sub_allotments')
            ->join('courses', 'sub_allotments.course_id', '=', 'courses.course_id')
            ->join('semesters', 'sub_allotments.sem_id', '=', 'semesters.sem_id')
            ->join('subjects', 'sub_allotments.sub_id', '=', 'subjects.sub_id')
            ->select('courses.course_name', 'semesters.name', 'subjects.sub_name')
            ->where('sub_allotments.t_id', $teacherId)
            // ->where('sub_allotment.id', $id) // Assuming $id filters a specific sub_allotment
            ->get();

        return response()->json($allocations);
    }


    public function course()
    {
        $courses = Course::all();

        if ($courses->isNotEmpty()) {
            return response()->json($courses);
        } else {
            return response()->json(['message' => 'No courses found'], 404);
        }
    }

    public function semester()
    {
       $semesters = Semester::all();

        if ($semesters->isNotEmpty()) {
            return response()->json($semesters);
        } else {
            return response()->json(['message' => 'No courses found'], 404);
        }
    }

    public function semester_find($id)
    {
        $semesters = Semester::where('sem_id', $id)->get();

        if ($semesters->isNotEmpty()) {
            return response()->json($semesters);
        } else {
            return response()->json(['message' => 'No courses found'], 404);
        }
    }

    public function subject()
    {
        $subjects = Subject::all();

        if ($subjects->isNotEmpty()) {
            return response()->json($subjects);
        } else {
            return response()->json(['message' => 'No subjects found'], 404);
        }
    }

    public function teacher()
    {
        $teachers = Teacher::all();
        // $teachers = Teacher::selectRaw('CONCAT_WS(" ", first_name, middle_name, last_name) AS full_name')->get();

        if ($teachers->isNotEmpty()) {
            return response()->json($teachers);
        } else {
            return response()->json(['message' => 'No teachers found'], 404);
        }
    }
    public function getStudentCountBySemester($id)
    {
        $semesterId = $id;
        $data = DB::table('students')
            ->join('courses', 'students.course_id', '=', 'courses.course_id')
            ->where('students.sem_id', $semesterId)
            ->where('students.approval_status', 1)
            ->select('courses.course_name as course_name', DB::raw('COUNT(students.id) as student_count'))
            ->groupBy('courses.course_name')
            ->get();
        return response()->json($data, 200);
    }
}
