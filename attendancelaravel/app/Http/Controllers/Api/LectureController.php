<?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Models\Lecture;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;


// class LectureController extends Controller
// {
//     public function index()
//     {
//         $lectures = Lecture::all();
//         return response()->json($lectures);
//     }

//     public function show($id)
//     {
//         $lecture = Lecture::find($id);

//         if (!$lecture) {
//             return response()->json(['message' => 'Lecture not found'], Response::HTTP_NOT_FOUND);
//         }

//         return response()->json($lecture);
//     }

//     // Create a new lecture
//     public function store(Request $request)
//     {
//         $request->validate([
//             'lec_date' => 'required|date',
//             'course_id' => 'required|integer|exists:courses,course_id',
//             'sem_id' => 'required|integer|exists:semesters,sem_id',
//             'sub_id' => 'required|integer|exists:subjects,sub_id',
//             'lec_topic' => 'required|string',
//             'lec_method' => 'required|string',
//             'lec_no' => 'required|integer',
//             'proxy_status' => 'required',
//             't_id' => 'required|integer|exists:teachers,id',
//         ]);
//         // dd($request);

//         $lecture = Lecture::create($request->all());

//         return response()->json($lecture, Response::HTTP_CREATED);
//     }

//     public function update(Request $request, $id)
//     {
//         $lecture = Lecture::find($id);

//         if (!$lecture) {
//             return response()->json(['message' => 'Lecture not found'], Response::HTTP_NOT_FOUND);
//         }

//         $request->validate([
//             'lec_date' => 'required|date',
//             'course_id' => 'required|integer|exists:courses,course_id',
//             'sem_id' => 'required|integer|exists:semesters,sem_id',
//             'sub_id' => 'required|integer|exists:subjects,sub_id',
//             'lec_topic' => 'required|string',
//             'lec_method' => 'required|string',
//             'lec_no' => 'required|integer',
//             'proxy_status' => 'required|string',
//             't_id' => 'required|integer|exists:teachers,id',

//         ]);

//         $lecture->update($request->all());

//         return response()->json($lecture);
//     }

//     public function destroy($id)
//     {
//         $lecture = Lecture::find($id);

//         if (!$lecture) {
//             return response()->json(['message' => 'Lecture not found'], Response::HTTP_NOT_FOUND);
//         }

//         $lecture->delete();

//         return response()->json(['message' => 'Lecture deleted successfully']);
//     }
// }


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    public function index()
    {
        $lectures = Lecture::with('subject:sub_id,sub_name')->get();
        return response()->json($lectures);
    }

    public function show($id)
    {
        $lecture = Lecture::find($id);

        if (!$lecture) {
            return response()->json(['message' => 'Lecture not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($lecture);
    }

    // Create a new lecture
    public function store(Request $request)
    {
        $request->validate([
            'lec_date' => 'required|date',
            'course_id' => 'required|integer|exists:courses,course_id',
            'sem_id' => 'required|integer|exists:semesters,sem_id',
            'sub_id' => 'required|integer|exists:subjects,sub_id',
            'lec_topic' => 'required|string',
            'lec_method' => 'required|string',
            'lec_no' => 'required|integer',
            'proxy_status' => 'required|string',
            't_id' => 'required|integer|exists:teachers,id',
        ]);

        $lecture = Lecture::create($request->all());

        return response()->json($lecture, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $lecture = Lecture::find($id);

        if (!$lecture) {
            return response()->json(['message' => 'Lecture not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'lec_date' => 'required|date',
            'course_id' => 'required|integer|exists:courses,course_id',
            'sem_id' => 'required|integer|exists:semesters,sem_id',
            'sub_id' => 'required|integer|exists:subjects,sub_id',
            'lec_topic' => 'required|string',
            'lec_method' => 'required|string',
            'lec_no' => 'required|integer',
            'proxy_status' => 'required|string',
            't_id' => 'required|integer|exists:teachers,id',

        ]);

        $lecture->update($request->all());

        return response()->json($lecture);
    }

    public function destroy($id)
    {
        $lecture = Lecture::find($id);

        if (!$lecture) {
            return response()->json(['message' => 'Lecture not found'], Response::HTTP_NOT_FOUND);
        }

        $lecture->delete();

        return response()->json(['message' => 'Lecture deleted successfully']);
    }

    public function fetchStudentsAttendance(Request $request)
    {
        $course_id = $request->input('c_id');
        $sem_id = $request->input('s_id');
        $opr = $request->input('opr');
        $lec_id = $request->input('l_id');

        $students = Student::where('course_id', $course_id)::where('sem_id', $sem_id)::where('approval_status', 1)::orderBy('roll_no', 'asc')::get(['s_id', 's_fname', 's_mname', 's_lname', 'roll_no']);

        $response = '<table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Roll.No.</th>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>';

        if ($students->count() > 0) {
            $absentStudents = [];
            if ($opr == 1) {
                $absentStudents = DB::table('stud_attend')
                    ->where('p_flag', 'A')
                    ->where('lec_id', $lec_id)
                    ->pluck('s_id')
                    ->toArray();
            }

            $str = ",";
            foreach ($students as $student) {
                $statusButton = in_array($student->s_id, $absentStudents) ?
                    "<div class='btn btn-danger' id='{$student->s_id}' onclick='getabsentids(this,\"{$student->s_id}\")'>Absent</div>" :
                    "<div class='btn btn-primary' id='{$student->s_id}' onclick='getabsentids(this,\"{$student->s_id}\")'>Present</div>";

                $response .= "
                    <tr>
                        <td>{$student->roll_no}</td>
                        <td>{$student->last_name}</td>
                        <td>{$student->middele_name}</td>
                        <td>{$student->first_name}</td>
                        <td>$statusButton</td>
                    </tr>";
                $str .= "{$student->s_id},";
            }

            $response .= "<td colspan='5'><center><input type='submit' class='btn btn-primary' name='btn_submit' id='btn_submit' value='" . ($opr == 0 ? 'Save' : 'Update') . "'/></center></td></tr>";
        } else {
            $response .= "<tr><td colspan='5'>No Records Found</td></tr>";
        }

        $response .= '</tbody></table>';
        $response .= "<input type='hidden' id='txt_abno' name='txt_abno' value='$str'>";

        return response($response);
    }
}
