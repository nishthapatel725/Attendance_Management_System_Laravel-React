<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    public function index()
{
    $semesters = Semester::all(); 
    return view('semester.index', compact('semesters'));
}

public function store(Request $request)
{
    Semester::create($request->all()); 
    return redirect()->route('semester.index')->with('success', 'Semester created successfully.');
}

public function edit($sem_id)
{
    $semester = Semester::findOrFail($sem_id); 
    $semesters = Semester::all(); 
    return view('semester.index', compact('semesters', 'semester')); 
}

public function update(Request $request, $sem_id)
{
    $semester = Semester::findOrFail($sem_id); 
    $semester->update($request->all()); 
    return redirect()->route('semester.index')->with('success', 'Semester updated successfully.');
}

public function destroy($sem_id)
{
    $semester = Semester::findOrFail($sem_id); 
    $semester->delete(); 
    return redirect()->route('semester.index')->with('success', 'Semester deleted successfully.');
}

}
