<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CourseController extends Controller
{
    //display all courses
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses, 200);
    }

    //names of all courses
    public function getCourseCode()
    {
        $courseCode = Course::all()->pluck('course_code');
        return response()->json($courseCode, 200);
    }
    //store course method
    public function store()
    {
        $course_dele_id =1;
        $data = request()->validate([
            
            'course_code' => 'required|unique:courses',
            'title'     => 'required|unique:courses',
            'credit_value' => 'required|min:1',
            'type' => 'required',
            'semester' => 'required'
        ]);
        $course_id = DB::table('courses')->insertGetId($data);
        $attends = DB::table('attends')->insert(['course_id'=> $course_id, 'course_delegate_id' => $course_dele_id]);
        return response()->json($attends, 201);
    }

    public function show(Course $course)
    {
        return response()->json($course, 200);
    }


    //update course profile
    public function update(course $course)
    {
        $data = request()->validate([
            'course_code' => 'required',
            'title' => 'required',
            'credit_value' => 'required|numeric',
            'type' => 'required',
            'semester' => 'required'
        ]);
        $course->update($data);
        return response()->json($course, 200);
    }

    //delete course
    public function destroy(course $course)
    {
        $course->delete();
        return response()->json(null, 204);
    }
}
