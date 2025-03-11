<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SubAllotment;
use Illuminate\Http\Request;

class AllocateSubjectController extends Controller
{
    public function index()
    {
        $subAllotments = SubAllotment::with(['course', 'semester', 'subject', 'teacher'])->get();

        $courses = Course::all();
        $semesters = Semester::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('allocate-subject.index', compact('subAllotments', 'courses', 'semesters', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'sem_id' => 'required|exists:semesters,sem_id',
            'sub_id' => 'required|exists:subjects,sub_id',
            't_id' => 'required|exists:teachers,id',
            'academic_year' => 'required|string|max:255',
        ]);

        SubAllotment::create([
            'course_id' => $request->course_id,
            'sem_id' => $request->sem_id,
            'sub_id' => $request->sub_id,
            't_id' => $request->t_id,  // Corrected this line
            'academic_year' => $request->academic_year,
        ]);

        return redirect()->route('allocate-subject.index')->with('success', 'Record added successfully');
    }

    public function edit($id)
    {
        $subAllotment = SubAllotment::findOrFail($id);
        $subAllotments = SubAllotment::all();

        $courses = Course::all();
        $semesters = Semester::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
    
        return view('allocate-subject.index', compact('subAllotment', 'subAllotments', 'courses', 'semesters', 'subjects', 'teachers'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'sem_id' => 'required|exists:semesters,sem_id',
            'sub_id' => 'required|exists:subjects,sub_id',
            't_id' => 'required|exists:teachers,id',
            'academic_year' => 'required|string|max:255',
        ]);

        $subAllotment = SubAllotment::findOrFail($id);
        $subAllotment->update([
            'course_id' => $request->course_id,
            'sem_id' => $request->sem_id,
            'sub_id' => $request->sub_id,
            't_id' => $request->t_id,  // Corrected this line
            'academic_year' => $request->academic_year,
        ]);

        return redirect()->route('allocate-subject.index')->with('success', 'Record updated successfully.');
    }

    public function destroy($id)
    {
        $subAllotment = SubAllotment::findOrFail($id); 
        $subAllotment->delete();

        return redirect()->route('allocate-subject.index')->with('success', 'Record deleted successfully.');
    }
}
