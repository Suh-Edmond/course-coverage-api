<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AttendsController extends Controller
{
//get all courses attended by a course delegate
        public function index(Request $request)
        {
            //$id = Auth::user()->id;
            $attend_course = DB::table('users')
                          ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                          ->join('attends','users.id', '=','attends.user_id')
                          ->join('courses','courses.id', '=', 'attends.course_id')
                          ->where('users.id', '=', 47)
                          ->where('user_types.type', '=','Course Delegate')
                          ->select('courses.*')
                          ->distinct()
                          ->get();
            return response()->json($attend_course, 200);
             
        }
        //get number courses for a course delegate 
        public function getNumberOfCoursePerCourseDelegate()
        {
            //$id = Auth::user()->user_id;
            $num = DB::table('users')
                          ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                          ->join('attends','users.id', '=','attends.user_id')
                          ->join('courses','courses.id', '=', 'attends.course_id')
                          ->where('users.id', '=', 47)
                          ->where('user_types.type', '=','Course Delegate')
                          ->select('courses.*')
                          ->distinct()
                          ->count();
            return response()->json($num);
        }
}
