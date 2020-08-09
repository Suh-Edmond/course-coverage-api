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

 
    //store course method
    public function store()
    {
        $course_dele_id =1;
        $data = request()->validate([
            
            'course_code' => 'required|unique:courses',
            'title'     => 'required|unique:courses',
            'credit_value' => 'required|min:1',
            'type' => 'required',
            'semester' => 'required',
            'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
        ]);
        $course_id = DB::table('courses')->insertGetId([
            'course_code' => $data['course_code'],
            'title' => $data['title'],
            'credit_value' => $data['credit_value'],
            'type' => $data['type'],
            'semester' => $data['semester'],
            'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            ]);
        $attends = DB::table('attends')->insert([
            'course_id'=> $course_id, 
            'course_delegate_id' => $course_dele_id,
            'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            ]);
        $courses = $this->index();   
        return $courses;
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
        $course->update([
            'course_code' => $data['course_code'],
            'title' => $data['title'],
            'credit_value' => $data['credit_value'],
            'type' => $data['type'],
            'semester' => $data['semester'],
            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            ]);
        return response()->json($course, 200);
    }
 
}
