<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Studattend;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    // Get all attendance records
    public function index()
    {
        return StudAttend::all();
    }

    // Get attendance record by lecture ID
    public function show($lec_id)
    {
        return StudAttend::where('lec_id', $lec_id)->get();
    }

    // Store attendance record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lec_id' => 'required|integer',
            's_id' => 'required|integer',
            'p_flag' => 'required',
        ]);

        return StudAttend::create($validated);
    }

    // Update attendance record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'p_flag' => 'required|boolean',
        ]);

        $attend = StudAttend::findOrFail($id);
        $attend->update($validated);

        return $attend;
    }

    // Delete attendance record
    public function destroy($id)
    {
        $attend = StudAttend::findOrFail($id);
        $attend->delete();

        return response()->json(['message' => 'Attendance record deleted']);
    }

    public function updateAttendence($s_id ,$lec_id ,Request $request)
    {
        // Validate the incoming request

        $request->validate([
            'p_flag' => 'required',  // Assuming you are updating the 'status' field (e.g., Present/Absent)
        ]);

        // Find the attendance record by roll_no and lect_id
        $attendance = StudAttend::where('s_id', $s_id)
                                ->where('lec_id', $lec_id)
                                ->first();
                                // dd($attendance);
        // If the record exists, update it
        if ($attendance) {
            $attendance->p_flag = $request->input('p_flag');  // Update the status (e.g., Present/Absent)
            $attendance->save();  // Save the changes

            return response()->json([
                'message' => 'Attendance updated successfully!',
                'attendance' => $attendance,
            ], 200);
        } else {
            // If the record doesn't exist, return an error
            return response()->json([
                'message' => 'Attendance record not found!',
            ], 404);
        }
    }

}
