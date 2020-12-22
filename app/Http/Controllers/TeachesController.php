<?php

namespace App\Http\Controllers;

use App\Teaches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TeachesController extends Controller
{

    //get all lecturers for a particular course
    public function getCourseLecturers(Request $request) 
    {
      // $lecturer_id = $request->all()[1];
      $course = (array)$request->all();
      $lecturers = DB::table('teaches')
                        ->join('users', 'teaches.user_id', '=', 'users.id')
                        ->join('user_types', 'users.user_type_id', '=','user_types.id')
                        ->join('courses', 'teaches.course_id', '=', 'courses.id')
                        ->where('user_types.type', '=', 'Lecturer')
                        ->where('courses.id', '=', $course['course_id'])
                        ->select('users.id','users.first_name', 'users.last_name')->get();
        return response()->json(['data'=>$lecturers, 'status'=>200]);
    }

    //add lecturer courses
    public function store(Request $request) {
       // $course_dele_id =Auth::user()->user_id;
       // $lecturer_id =Auth::user()->user_id;
       // $type = Auth::user()->user_type;
        $id = 3;//faker lecturer_id need to pass the current authenticated lecturer
        $course = $request->all();
        $lect_course = DB::table('teaches')->insert([
        'user_id' => $id,  
        'course_id'=> $course['id']
        ]);
        $courses = $this->index($request);
        return response()->json(['data'=>$courses, 'message'=>'Successfully added Course','status'=>200]);
        
    }

      //get all course  for a lecturer
      public function index(Request $request) 
      {
        //$lecturer_id =Auth::user()->user_id;
        //$type = Auth::user()->user_type;
        $id = 38; //fake lecturer id
        $course = DB::table('teaches')
                ->join('courses', 'courses.id', '=', 'teaches.course_id')
                ->join('users', 'users.id', '=', 'teaches.user_id')
                ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                ->where('users.id', '=', $id)
                ->select('courses.id','courses.course_code', 'courses.title','courses.credit_value','courses.type','courses.semester')
                ->orderBy('courses.type', 'desc')->get();
        return response()->json(['data'=>$course, 'status'=>200]);
      }
      //get number of course for a lecturer
      public function getCourseNumber(Request $request)
      {
        //$lecturer_id =Auth::user()->user_id;
        //$type = Auth::user()->user_type;
        $id =38;//fake lecturer id
        $course_number = DB::table('teaches')
                      ->join('courses', 'courses.id', '=', 'teaches.course_id')
                      ->join('users', 'teaches.user_id', '=', 'users.id')
                      ->join('user_types', 'users.user_type_id', '=','user_types.id')
                      ->where('users.id', '=', $id)
                      ->where('user_types.type', '=', 'Lecturer')
                      ->select('courses.id')->distinct()->count();
        return response()->json(['data'=>$course_number, 'status'=>200]);
      }

      public function destroy(Teaches $course)
      {
        //$lecturer_id =Auth::user()->user_id;
        $id = 38;//fake lecturer id
        $deleted = DB::table('teaches')
                      ->where('teaches.user_id', '=', $id)
                      ->where('teaches.course_id', '=', $course)
                      ->delete();
        return response()->json(['data'=>$deleted, 'message'=>'Successfully deleted the Course', 'status'=>204]);
      }
}
