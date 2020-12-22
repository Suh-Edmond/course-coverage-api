<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    //display all courses
    public function index()
    {   
        $courses = DB::table('courses')
                    ->select(DB::raw('*'))
                    ->orderBy('courses.type', 'desc')->get();   
        return response()->json(['data'=>$courses, 'status'=>200]);
    }
    
 
    //create course method
    public function store()
    {
        //get the current authenticated course delegate to create the course
        // $course_dele_id =Auth::user()->user_id;
        // $type = Auth::user()->user_type;
        $data = request()->validate([
            'course_code' => 'required|unique:courses',
            'title'     => 'required|unique:courses',
            'credit_value' => 'required|min:1',
            'type' => 'required',
            'semester' => 'required',
        ]);
        $course_id = DB::table('courses')->insertGetId([
            'course_code' => $data['course_code'],
            'title' => $data['title'],
            'credit_value' => $data['credit_value'],
            'type' => $data['type'],
            'semester' => $data['semester'],
            ]);
        $attends = DB::table('attends')->insert([
            'course_id'=> $course_id, 
            'course_delegate_id' => 1,
            ]);
       
       return response()->json(['data'=>$attends, 'message'=>'Course was Succesfully Created', 'status'=>201]) ;
        
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
            ]);
        return response()->json(['data'=>$course, 'message'=>'Course was successfully updated', 'status'=> 200]);
    }

    //delete course

    public function destory(course $course)
    {
        $course->delete();
        return response()->json(['message'=>"Successfully deleted Course", "status"=>204 ]);
    }
 
}
