<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class RollNumberController extends Controller
{
    // Fetch courses and semesters for the form
    public function genrate_rollno()
    {
        $courses = Course::all();
        $semesters = Semester::all();

        return view('genrate_rollno', compact('courses', 'semesters'));
    }

    public function partials(Request $request)
    {
        $courseId = $request->input('c_id');
        $semesterId = $request->input('s_id');

        $students = DB::table('students')
                      ->select('id', 'first_name', 'middle_name', 'last_name')
                      ->where('course_id', $courseId)
                      ->where('sem_id', $semesterId)
                      ->where('approval_status', 1)
                      ->orderBy('last_name')
                      ->orderBy('first_name')
                      ->orderBy('middle_name')
                      ->get();

        return view('partials.student-table', compact('students'))->render();
    }

    public function saveRollNumbers(Request $request)
    {
        $course_id = $request->input('course_id');
        $sem_id = $request->input('sem_id');
        $rollNumbers = $request->except('_token', 'course_id', 'sem_id');
        $duplicateRollNos = [];

        DB::beginTransaction();

        try {
            foreach ($rollNumbers as $id => $roll_no) {
                if (is_numeric($id)) {
                    $existingStudent = Student::where('roll_no', $roll_no)
                        ->where('id', '!=', $id)
                        ->first();

                    if ($existingStudent) {
                        $duplicateRollNos[$id] = $roll_no;
                    } else {
                        Student::where('id', $id)
                            ->update(['roll_no' => $roll_no, 'updated_at' => now()]);
                    }
                }
            }

            if (!empty($duplicateRollNos)) {
                DB::rollBack();

                return redirect()->back()->withErrors([
                    'message' => 'Some roll numbers are already taken by other students.',
                    'duplicates' => $duplicateRollNos
                ]);
            }

            DB::commit();

            return redirect()->route('genrate_rollno')->with('success', 'Roll numbers updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => 'An error occurred while updating roll numbers. Please try again.']);
        }
    }
//     public function saveRollNumbers(Request $request)
// {
//     $course_id = $request->input('course_id');
//     $sem_id = $request->input('sem_id');
//     $rollNumbers = $request->except('_token', 'course_id', 'sem_id');
//     $duplicateRollNos = [];

//     // Pre-check for duplicates
//     foreach ($rollNumbers as $id => $roll_no) {
//         if (is_numeric($id)) {
//             $existingStudent = Student::where('roll_no', $roll_no)
//                 ->where('id', '!=', $id)
//                 ->first();

//             if ($existingStudent) {
//                 $duplicateRollNos[$id] = $roll_no;
//             }
//         }
//     }

//     // Stop saving if duplicates are found
//     if (!empty($duplicateRollNos)) {
//         return redirect()->back()->with('duplicates', $duplicateRollNos);
//     }

//     // If no duplicates, proceed with saving roll numbers
//     DB::beginTransaction();
//     try {
//         foreach ($rollNumbers as $id => $roll_no) {
//             if (is_numeric($id)) {
//                 Student::where('id', $id)
//                     ->update(['roll_no' => $roll_no, 'updated_at' => now()]);
//             }
//         }

//         DB::commit();

//         return redirect()->route('genrate_rollno')->with('success', 'Roll numbers updated successfully.');

//     } catch (\Exception $e) {
//         DB::rollBack();
//         return redirect()->back()->withErrors(['message' => 'An error occurred while updating roll numbers. Please try again.']);
//     }
// }


}
