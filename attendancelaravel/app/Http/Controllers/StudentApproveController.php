<?php
// namespace App\Http\Controllers;

// use App\Models\Student;
// use Illuminate\Http\Request;

// class StudentApproveController extends Controller
// {
//     public function index()
//     {
//         // Assuming you want to get students awaiting approval
//         $students = Student::where('approval_status', 0)
//             ->join('courses', 'students.course_id', '=', 'courses.course_id')
//             ->join('semesters', 'students.sem_id', '=', 'semesters.sem_id')
//             ->select('students.*', 'courses.course_name', 'semesters.name')
//             ->get();

//         return view('studentapprove.index', compact('students'));
//     }

//     public function approve($id)
//     {
//         $student = Student::findOrFail($id);
//         $student->approval_status = 1;
//         $student->save();

//         return redirect()->route('studentapprove.index')->with('status', 'Student approved successfully!');
//     }

//     public function reject($id)
//     {
//         $student = Student::find($id);
        
//         if ($student) {
//             $student->status = 'rejected'; 
//             $student->save();
//         }

//         return redirect()->route('studentapprove.index')->with('success', 'Student rejected successfully.');
//     }
// }


namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentApproveController extends Controller
{
    public function index()
    {
        // Fetch students awaiting approval with course and semester information
        $students = Student::where('approval_status', 0)
            ->join('courses', 'students.course_id', '=', 'courses.course_id')
            ->join('semesters', 'students.sem_id', '=', 'semesters.sem_id')
            ->select('students.*', 'courses.course_name', 'semesters.name')
            ->get();

        return view('studentapprove.index', compact('students'));
    }

    public function approve($id)
    {
        $student = Student::findOrFail($id);
        $student->approval_status = 1; // Assuming you have 'approval_status' column
        $student->save();

        return redirect()->route('studentapprove.index')->with('status', 'Student approved successfully!');
    }

    public function reject($id)
    {
        $student = Student::find($id);

        if ($student) {
            
            $student->approval_status = 2;
            $student->save();
        }

        return redirect()->route('studentapprove.index')->with('success', 'Student rejected successfully.');
    }
}

