<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all(); 
        return view('course.index', compact('courses'));
    }

    public function store(Request $request)
    {
        Course::create($request->all()); 
        return redirect()->route('course.index')->with('success', 'Course created successfully.');
    }

    public function edit($course_id)
    {
        
        $course = Course::findOrFail($course_id); 
        $courses = Course::all(); 
        return view('course.index', compact('courses', 'course')); 
    }

    public function update(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id); 
        $course->update($request->all()); 
        return redirect()->route('course.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($course_id)
    {
        $course = Course::findOrFail($course_id); 
        $course->delete(); 
        return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
    }

}
