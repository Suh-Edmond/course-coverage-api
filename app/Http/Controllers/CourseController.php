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
        
        $courses = Course::all();
        return response()->json($courses, 200);
    }
    public function index1()
    {
        $id = Auth::user()->user_id;
        $type = Auth::user()->user_type;
        if($type == 'course_delegates'){
            $courses = DB::table('attends')
            ->join('courses', 'courses.id', '=', 'attends.course_id')
            ->join('course_delegates', 'course_delegates.id', '=', 'attends.course_delegate_id')
            ->where('course_delegates.id', '=', $id)
            ->select('courses.id','courses.course_code', 'courses.title', 'courses.credit_value'
            ,'courses.type','courses.semester')->get();
    
        }
       return response()->json($courses, 200);
    }

 
    //store course method
    public function store()
    {
        $course_dele_id =Auth::user()->user_id;
        $type = Auth::user()->user_type;
        
        
       
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
        $courses = $this->index1();
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
