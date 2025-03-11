<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with(['course', 'semester'])->get();

        $courses = Course::all();
        $semesters = Semester::all();
        // dd($subjects);
        return view('subject.index', compact('subjects', 'courses', 'semesters'));
    }


    public function store(Request $request, Subject $subject)
    {
        // dd($request->all())
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'sem_id' => 'required|exists:semesters,sem_id',
            'sub_code' => 'required|string|max:255',
            'sub_name' => 'required|string|max:255',
        ]);

        Subject::create([
            'course_id' => $request->course_id,
            'sem_id' => $request->sem_id,
            'sub_code' => $request->sub_code,
            'sub_name' => $request->sub_name,
        ]);
        // Subject::create($request->all()); 
        
        return redirect()->route('subject.index')->with('success', 'Subject added successfully');
    }
   
    public function edit($sub_id)
    {
        $subject = Subject::findOrFail($sub_id);
        $subjects = Subject::all();
        $courses = Course::all();
        $semesters = Semester::all();

        return view('subject.index', compact('subject','subjects', 'courses', 'semesters'));
    }

    public function update(Request $request, $sub_id)
    {
        $subject = Subject::find($sub_id);

        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'sem_id' => 'required|exists:semesters,sem_id',
            'sub_code' => 'required|string|max:255',
            'sub_name' => 'required|string|max:255',
        ]);

        $subject->update([
            'course_id' => $request->course_id,
            'sem_id' => $request->sem_id,
            'sub_code' => $request->sub_code,
            'sub_name' => $request->sub_name,
        ]);

        return redirect()->route('subject.index')->with('success', 'Subject updated successfully');
    }

    public function destroy($sub_id)
    {
        $subject = Subject::find($sub_id);
        $subject->delete();

        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully');
    }
}

