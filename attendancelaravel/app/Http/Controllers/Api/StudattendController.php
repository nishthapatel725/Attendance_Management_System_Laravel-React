<?php

namespace App\Http\Controllers;

use App\Models\Studattend;
use Illuminate\Http\Request;

class StudattendController extends Controller
{
    // Get all attendance records
    public function index()
    {
        $stud_attend = Studattend::all();
        return response()->json([
            "stud_attend" => $stud_attend
        ]);
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
            'p_flag' => 'required',
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
}
