<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AttendsController extends Controller
{
    //get all courses for a course delegate 
        //names of all courses for a particular course delegate
        // public function index()
        // {
        //     $id = Auth::user()->user_id;
        //     $type = Auth::user()->user_type;
        //     $course = DB::table('attends')
        //             ->join('courses', 'courses.id', '=', 'attends.course_id')
        //             ->join('course_delegates', 'course_delegates.id', '=', 'attends.course_delegate_id')
        //             ->where('course_delegates.id', '=', $id)
        //             ->select('courses.id','courses.course_code', 'courses.title', 'courses.credit_value'
        //             ,'courses.type','courses.semester');
        // }

        public function getAttendCourse(Request $request)
        {
            $id = Auth::user()->user_id;
            $type = Auth::user()->user_type;
            if($type == 'course_delegates')
             {
                $request->all();
                $attend_course = DB::table('attends')
                ->join('courses', 'courses.id', '=', 'attends.course_id')
                ->join('course_delegates', 'course_delegates.id', '=', 'attends.course_delegate_id')
                ->where('course_delegates.id', '=', $id)
                ->select('courses.id','courses.course_code', 'courses.title', 'courses.credit_value'
                ,'courses.type','courses.semester')->get();
                 
             }
            
            return response()->json($attend_course, 200);
        }
}
