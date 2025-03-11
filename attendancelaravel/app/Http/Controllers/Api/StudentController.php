<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\StudAttend;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Get the course_id and sem_id from the request
    //     $courseId = $request->query('course_id');
    //     $semId = $request->query('sem_id');

    //     // Build the query
    //     $query = Student::query()->where('approval_status',1);

    //     // Apply filters if parameters are provided
    //     if ($courseId) {
    //         $query->where('course_id', $courseId);
    //     }

    //     if ($semId) {
    //         $query->where('sem_id', $semId);
    //     }

    //     // Execute the query and get the filtered students
    //     $students = $query->get();

    //     return response()->json($students);
    // }

    // public function attendence___($id)
    // {
    //     $student = Student::all();
    //     $lecture = Lecture::find($id);

    //     // Return the data
    //     return response()->json([
    //         'data' => [
    //             'student' => $student,
    //             'lecture' => $lecture,
    //         ],
    //     ]);
    // }

    // public function attendence________($id)
    // {
    //     $attend = StudAttend::with('student')->where('lec_id', $id)->get();
    //     return response()->json($attend);
    // }

    // public function attendence($id)
    // {
    //     $attend = StudAttend::join('students', 'stud_attend.s_id', '=', 'students.id')
    //     ->where('stud_attend.lec_id', $id)
    //     ->orderBy('students.roll_no', 'asc')
    //     ->select('stud_attend.*', 'students.roll_no')
    //     ->with('student')
    //     ->get();
    //     return response()->json($attend);
    // }
    public function index(Request $request)
    {
        // Get the course_id and sem_id from the request
        $courseId = $request->query('course_id');
        $semId = $request->query('sem_id');

        // Build the query
        $query = Student::query()->where('approval_status',1);

        // Apply filters if parameters are provided
        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        if ($semId) {
            $query->where('sem_id', $semId);
        }

        // Execute the query and get the filtered students
        $students = $query->get();

        return response()->json($students);
    }

    public function attendence___($id)
    {
        $student = Student::all();
        $lecture = Lecture::find($id);

        // Return the data
        return response()->json([
            'data' => [
                'student' => $student,
                'lecture' => $lecture,
            ],
        ]);
    }

    public function attendence________($id)
    {
        $attend = StudAttend::with('student')->where('lec_id', $id)->get();
        return response()->json($attend);
    }

    public function attendence($id)
    {
        $attend = StudAttend::join('students', 'stud_attend.s_id', '=', 'students.id')
        ->where('stud_attend.lec_id', $id)
        ->orderBy('students.roll_no', 'asc')
        ->select('stud_attend.*', 'students.roll_no')
        ->with('student')
        ->get();
        return response()->json($attend);
    }

    // public function getAttendanceCount($semester, $course, $date)
    // {
    //     // Validate the parameters
    //     if (!is_numeric($semester) || !is_numeric($course) || !strtotime($date)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid parameters',
    //         ], 400);
    //     }

    //     // Query to get attendance counts filtered by semester, course, and date
    //     $attendanceData = DB::table('stud_attend')
    //         ->join('lectures', 'stud_attend.lec_id', '=', 'lectures.id')
    //         ->where('lectures.sem_id', $semester)
    //         ->where('lectures.course_id', $course)
    //         ->whereDate('lectures.lec_date', $date)
    //         ->select(
    //             DB::raw("SUM(CASE WHEN stud_attend.p_flag = 'P' THEN 1 ELSE 0 END) as present_count"),
    //             DB::raw("SUM(CASE WHEN stud_attend.p_flag = 'A' THEN 1 ELSE 0 END) as absent_count")
    //         )
    //         ->first();

    //     // Return the response
    //     return response()->json([
    //         'success' => true,
    //         'data' => $attendanceData,
    //     ]);
    // }
    public function getAttendanceCount($semester, $course, $date)
{
    // Validate the parameters
    if (!is_numeric($semester) || !is_numeric($course) || !strtotime($date)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid parameters',
        ], 400);
    }

    // Enable query logging for debugging
    DB::enableQueryLog();

    // Query to get attendance counts
    $attendanceData = DB::table('stud_attend')
        ->join('lectures', 'stud_attend.lec_id', '=', 'lectures.id')
        ->where('lectures.sem_id', $semester)
        ->where('lectures.course_id', $course)
        ->whereDate('lectures.lec_date', $date)
        ->select(
            DB::raw("SUM(CASE WHEN stud_attend.p_flag = 'P' THEN 1 ELSE 0 END) as present_count"),
            DB::raw("SUM(CASE WHEN stud_attend.p_flag = 'A' THEN 1 ELSE 0 END) as absent_count")
        )
        ->first();

    // Log the executed query
    $queryLog = DB::getQueryLog();

    // Debugging the data
    if (!$attendanceData) {
        return response()->json([
            'success' => false,
            'message' => 'No data found',
            'query' => $queryLog,
        ]);
    }

    return response()->json([
        'success' => true,
        'data' => $attendanceData,
        'query' => $queryLog, // Include query log for debugging
    ]);
}

}
